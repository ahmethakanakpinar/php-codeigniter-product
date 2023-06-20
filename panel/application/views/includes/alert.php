<?php $alert = $this->session->userdata("alert"); ?>
<?php if($alert): ?>
    <?php if($alert["type"] === "success"): ?>
        <script>
            iziToast.success({
                title: '<?php echo $alert["title"]; ?>',
                message: '<?php echo $alert["text"]; ?>',
                position: "topCenter"
            })
        </script>
    <?php else: ?>
        <script>
            iziToast.error({
                title: '<?php echo $alert["title"]; ?>',
                message: '<?php echo $alert["text"]; ?>',
                position: "topCenter"
            })
        </script>
    <?php endif; ?>
<?php endif; ?>
<?php $this->session->unset_userdata("alert"); ?>