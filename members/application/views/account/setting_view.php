<h4 class="heading_a">Setting</h4>
<div class="md-card">
    <div class="md-card-content">
        <div class="uk-grid uk-grid-divider" data-uk-grid-margin>
            <div class="uk-width-large-1">
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-1-5">
                        <ul id="setting_a" class="uk-tab uk-tab-left" data-uk-tab="{connect:'#tab_setting', animation:'slide-horizontal'}">
                            <li name="basic_set" class="uk-active"><a href="#">Basic Settings</a></li>
                            <li name="priv_set"><a href="#">Privacy settings</a></li>
                            <li name="noti_set"><a href="#">Notification Settings</a></li>
                        </ul>
                    </div>
                    <div class="uk-width-2-5">
                        <ul id="tab_setting" class="uk-switcher uk-margin-small-top">
                            <li id="basic-setting"></li>
                            <li id="privacy">Privacy Setting</li>
                            <li id="notification">Notification Setting</li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>



<script>

   
   $(document).ready(function () {
     $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/basicSetingView',
                      data: {},
                  })
                .done(function(data){
                  $('#basic-setting').html(data);
                })

            $("#setting_a li").click(function () {                
                var tab_value=$(this).attr('name');
                console.log(tab_value); 
               
              if(tab_value=="basic_set") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/basicSetingView',
                      data: {},
                  })
                .done(function(data){
                  $('#basic-setting').html(data);
                })
              }

              if(tab_value=="priv_set") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/privacySettingView',
                      data: {},
                  })
                .done(function(data){
                  $('#privacy').html(data);
                })
              }


    });
});

</script>
 