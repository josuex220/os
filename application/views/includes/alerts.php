<?php 
if($this->session->flashdata('info')){
?>
    <div class="alert alert-primary" role="alert"><?=$this->session->flashdata('info')?></div>
<?php } ?>
<?php 
if($this->session->flashdata('error')){
?>
    <div class="alert alert-danger" role="alert"><?=$this->session->flashdata('error')?></div>
<?php } ?>
<?php 
if($this->session->flashdata('success')){
?>
    <div class="alert alert-success" role="alert"><?=$this->session->flashdata('success')?></div>
<?php } ?>