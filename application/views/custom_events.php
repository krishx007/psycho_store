  <?php
  if(isset($scripts) && count($scripts))
  {
    foreach ($scripts as $key => $script)
    {
      $this->load->view($script['path'], $script['params']);
    }
  }
  ?>