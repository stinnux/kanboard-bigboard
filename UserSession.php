<?php

namespace Kanboard\Plugin\Bigboard;

class UserSession extends \Kanboard\Core\User\UserSession
{
  /**
   *  is the Bigboard collapsed or expanded
   *
   * @access public
   * @return boolean
   */
   public function isBigboardCollapsed()
   {
     return session_is_true('bigboardCollapsed');
   }

   /**
    * Set Bigboard display mode
    *
    * @access public
    * @param  boolean  $is_collapsed
    */
   public function setBigboardDisplayMode($is_collapsed)
   {
     session_set('bigboardCollapsed', true);
   }

}
