<?php
 if ($this->session -> userdata('email') == "" && $this->session -> userdata('login') != true && $this->session -> userdata('permissao') != 1) {
      redirect('administrator/index');
    }
 ?>
<ul class="">
    <li>
        <span>Dashboard</span>
    </li>
    <li>
        <span>Users</span>
    </a>
    <li>
        <span>Configurações</span>
    </li>
</ul>
    <div class="main-body">
        <div class="page-wrapper">




     



