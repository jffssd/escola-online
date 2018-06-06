<div class="col-md-12" style="margin-bottom: -40px;">
    <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success icons-alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="icofont icofont-close-line-circled"></i>
            </button>
            <p><strong>Success! &nbsp;&nbsp;</strong><?php echo $this->session->flashdata('success');?></p>
        </div>
    <?php
    } 
    if($this->session->flashdata('error')){ ?>
    <div class="alert alert-danger icons-alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="icofont icofont-close-line-circled"></i>
        </button>
        <p><strong>Error! &nbsp;&nbsp;</strong><?php echo $this->session->flashdata('error');?></p>
    </div>
    <?php } ?>
</div>