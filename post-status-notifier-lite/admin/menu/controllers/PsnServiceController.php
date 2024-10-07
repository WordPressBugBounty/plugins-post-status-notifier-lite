<?php
/**
 * Service controller
 *
 * @author   Timo Reith <timo@ifeelweb.de>
 * @version  $$Id: PsnServiceController.php 3137090 2024-08-17 17:41:42Z worschtebrot $$
 * @package  IfwPsn_Wp
 */
class PsnServiceController extends PsnApplicationController
{
    /**
     * @var IfwPsn_Wp_Email
     */
    protected $_email;



    public function preDispatch()
    {
        if ($this->_request->has('send_test_mail')) {


        }
    }

    public function onCurrentScreen()
    {
    }

    /**
     *
     */
    public function indexAction()
    {
        $this->_initHelp();

        // set up metaboxes
        $metaBoxContainer1 = new IfwPsn_Wp_Plugin_Metabox_Container('column1', $this->_pageHook, 'normal-1');
        $metaBoxContainer2 = new IfwPsn_Wp_Plugin_Metabox_Container('column2', $this->_pageHook, 'normal-2');
        $metaBoxContainer3 = new IfwPsn_Wp_Plugin_Metabox_Container('column3', $this->_pageHook, 'normal-3');
        $metaBoxContainer4 = new IfwPsn_Wp_Plugin_Metabox_Container('column4', $this->_pageHook, 'normal-4');

        $metaBoxContainer1->addMetabox(new Psn_Admin_Metabox_TestMail($this->_pm));
        $metaBoxContainer2->addMetabox(new Psn_Admin_Metabox_ServerEnv($this->_pm));

        do_action('psn-service-metabox-col1', $metaBoxContainer1);
        do_action('psn-service-metabox-col2', $metaBoxContainer2);
        do_action('psn-service-metabox-col3', $metaBoxContainer3);
        do_action('psn-service-metabox-col4', $metaBoxContainer4);

        $this->view->metaBoxContainer1 = $metaBoxContainer1;
        $this->view->metaBoxContainer2 = $metaBoxContainer2;
        $this->view->metaBoxContainer3 = $metaBoxContainer3;
        $this->view->metaBoxContainer4 = $metaBoxContainer4;
    }

    /**
     *
     */
    public function sendTestMailAction()
    {
        if (!$this->verifyNonce('psn-form-test-mail')) {
            $this->getAdminNotices()->persistError(__('Invalid access.', 'psn'));
            $this->_gotoIndex();
        }

        $this->_email = new IfwPsn_Wp_Email();

        $subject = sprintf(__('Test Email from %s', 'psn'), $this->_pm->getEnv()->getName());

        $body = IfwPsn_Wp_Proxy_Filter::apply('psn_send_test_mail_body', sprintf(
            __('This is a test email generated by %s on %s (%s)', 'psn'),
                $this->_pm->getEnv()->getName(),
                IfwPsn_Wp_Proxy_Blog::getName(),
                IfwPsn_Wp_Proxy_Blog::getUrl()
        ), $this->_email);

        switch (trim($this->_request->get('recipient'))) {
            case 'custom':
                $recipient = esc_attr($_POST['custom_recipient']);
                break;
            case 'admin':
            default:
                $recipient = IfwPsn_Wp_Proxy_Blog::getAdminEmail();
                break;
        }

        $recipient = IfwPsn_Wp_Proxy_Filter::apply('psn_send_test_mail_recipient', $recipient);

        if (empty($recipient)) {

            $resultMsg = __('Invalid recipient.', 'psn') . ' ' . __('Test email could not be sent.', 'psn');
            $this->getAdminNotices()->persistError($resultMsg);

        } else {

            $this->_email->setTo($recipient)
                ->setSubject($subject)
                ->setMessage($body)
            ;

            do_action('psn_send_test_mail', $this->_email);

            if ($this->_email->send()) {
                // mail sent successfully
                $resultMsg = __('Test email has been sent successfully.', 'psn');
                $this->getAdminNotices()->persistUpdated($resultMsg);

                do_action('psn_send_test_mail_success', $this);

            } else {
                // email could not be sent
                $resultMsg = __('Test email could not be sent.', 'psn');
                $this->getAdminNotices()->persistError($resultMsg);

                do_action('psn_send_test_mail_failure', $this);
            }

            do_action('psn_after_test_email_send', $this->_email);
        }

        $this->_gotoIndex();
    }

    protected function _initHelp()
    {
        $help = new IfwPsn_Wp_Plugin_Menu_Help($this->_pm);
        $help->setTitle(__('Help', 'psn'))
            ->setHelp($this->_getDefaultHelpText())
            ->setSidebar($this->_getHelpSidebar())
            ->load();
    }

    /**
     * @return string
     */
    protected function _getDefaultHelpText()
    {
        return '';
    }
}