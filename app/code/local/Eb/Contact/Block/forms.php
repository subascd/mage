<?php
class Eb_Contact_Block_Forms extends Mage_Core_Block_Abstract implements Mage_Widget_Block_Interface {
/**
  * Produce links list rendered as html
  *
  * @return string
  */
  protected function _toHtml() {
    $html = '';
    // $link_options = self::getData('form_options');
    $link_options = $this->getData('link_options');
    //var_dump($link_options);die;
      
    if (empty($link_options)) {
      return $html;
    }
      
    $arr_options = explode(',', $link_options);
      
    if (is_array($arr_options) && count($arr_options)) {
      foreach ($arr_options as $option) {
        Switch ($option) {
          case 'contactform':
            $html .= '<div><form action="" method="post">
                      <fieldset>
                      <legend>Contact Form:</legend>
                      First name:<br>
                      <input type="text" name="firstname" value="Subas">
                      <br>
                      Last name:<br>
                      <input type="text" name="lastname" value="Dhungana">
                      <br><br>
                      <input type="submit" name="send" value="Submit"></fieldset>
                      </form></div>';
            if (isset($_POST['send'])){          
              $to = 'subash@ebpearls.com';
              $subject = 'Contact Us';
              $desc = 'This is description';
              if(mail($to,$subject,$desc)){
                echo "<div style='color:red';>Thank you for contacting us :)</div>";
              }else{
                echo "<div style='color:red';>Unable to send form :(</div>";
              }
            }
          break;

          case 'email':
            $html .= '<div><a href="mailto:subash@ebpearls.com&subject=Contact Us">Send Email</a></div>';
          break;
        }
      }
    }
     
    return $html;
  }
}