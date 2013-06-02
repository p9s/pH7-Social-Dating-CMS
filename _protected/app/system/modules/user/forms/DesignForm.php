<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / User / Form
 */
namespace PH7;

use PH7\Framework\Mvc\Router\UriRoute;

class DesignForm
{

    public static function display()
    {
        if (isset($_POST['submit_design']))
        {
            if (\PFBC\Form::isValid($_POST['submit_design']))
                new DesignFormProcessing();

            Framework\Url\HeaderUrl::redirect();
        }

        $oForm = new \PFBC\Form('form_design', 500);
        $oForm->configure(array('action' => ''));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_design', 'form_design'));
        $oForm->addElement(new \PFBC\Element\Token('design'));
        if (AdminCore::auth() && !User::auth())
        {
            $oForm->addElement(new \PFBC\Element\HTMLExternal('<p class="center"><a class="m_button" href="' . UriRoute::get(PH7_ADMIN_MOD, 'user', 'browse') . '">' . t('Back to Browse Users') . '</a></p>'));
        }
        $oForm->addElement(new \PFBC\Element\File(t('Your Wallpaper for your Profile:'), 'wallpaper', array('accept'=>'image/*', 'required'=>1)));
        $oForm->addElement(new \PFBC\Element\Button);
        $oForm->render();
    }

}
