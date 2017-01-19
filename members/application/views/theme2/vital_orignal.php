<!--  Start Vital Section -->
<div class="ac_am_academic">
     <h4>Vitals</h4>

        <!-- Start Technical Section -->
        <div class="sub_section">
            <div class="sub_title"><h4>Technical</h4></div>
               

           <?php if(!empty($tech_details)){ ?>
           <div class="vital_con" id="technical_view">
            <div id="container_tech" style="min-width: 300px; height: 300px; max-width: 600px; margin: 0 auto"></div>

            </div>
         
           
      
      
      <script type="text/javascript">

            $(function () {
                $('#container_tech').highcharts({
                    colors: ['#f36e0e', '#f47921', '#f58433', '#f69046', '#f79b59', '#f8a66b', 
                         '#f9b17e', '#fabd91', '#fac8a3','#fbd3b6','#fcdec9','#fdeadc','#fef5ee'],
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: 0,
                        plotShadow: false
                    },
                    title: {
                        text: 'Technical <br>'+ <?php echo $per_technical['percent'];?>+'%',
                        align: 'center',
                        verticalAlign: 'middle',
                        y: 60
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.y}/10</b>'
                    },
                    plotOptions: {
                        pie: {
                            dataLabels: {
                                enabled: false,
                                distance: -50,
                                style: {
                                    fontWeight: 'bold',
                                    color: 'white',
                                    textShadow: '0px 1px 2px black'
                                }
                            },
                            startAngle: -180,
                            endAngle: 180,
                            center: ['50%', '75%']
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'Strength',
                        innerSize: '50%',
                        data: [{name: 'Technique',y: <?php echo $tech_details->technique;?>},
                               {name: 'Finishing',y: <?php echo $tech_details->finishing;?>},
                               {name: 'Shooting',y: <?php echo $tech_details->shooting;?>},
                               {name: 'Receiving',y: <?php echo $tech_details->receiving;?>},
                               {name: 'Control',y: <?php echo $tech_details->control;?>},
                               {name: 'Heading', y: <?php echo $tech_details->heading;?>},
                               {name: 'Shielding',y: <?php echo $tech_details->shielding;?>},
                               {name: 'Distribution',y: <?php echo $tech_details->distribution;?>},
                               {name: 'Accuracy',y: <?php echo $tech_details->accuracy;?>},
                               {name: 'Long Passing',y: <?php echo $tech_details->long_passing;?>},
                               {name: 'Turning',y: <?php echo $tech_details->turning;?>},
                               {name: 'Aerial Control',y: <?php echo $tech_details->aerial_control;?>},
                               {name: 'Dribbling',y: <?php echo $tech_details->dribbling;?>},
                               {name: 'Running',y: <?php echo $tech_details->running;?>},
                               {name: 'Defending',y: <?php echo $tech_details->defending;?>}
                            ]
                    }]
                });
            });
       </script>

          <?php } 


           else { ?>

                <h5> Don't have Technical Rating </h5>
                
         <?php   } ?>
        </div>
      <!-- End Technical Section -->





        <!-- Start Tactical Section -->

        <div class="sub_section">

            <div class="sub_title"><h4>Tactical</h4></div>         



            <?php if(!empty($tact_details)){ ?>

            <div class="vital_con" id="tactical_view">
                  <div id="container_tactical" style="min-width: 300px; height: 300px; max-width: 600px; margin: 0 auto"></div>
             </div>

<script type="text/javascript">
      $(function () {
            $('#container_tactical').highcharts({
                colors: ['#27d97e','#38dc88','#49df92','#5ae29c','#6ae5a6','#7be8b0','#8cebba','#9ceec4',
                          '#adf1ce','#bef4d8','#cff7e2','#dff9ec','#f0fcf6'],
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: 0,
                    plotShadow: false
                },
                title: {
                    text: 'Tactical <br>'+ <?php echo $per_tachtical['percent'];?>+'%',
                    align: 'center',
                    verticalAlign: 'middle',
                    y: 60
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}/10</b>'
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            enabled: false,
                            distance: -50,
                            style: {
                                fontWeight: 'bold',
                                color: 'white',
                                textShadow: '0px 1px 2px black'
                            }
                        },
                        startAngle: -180,
                        endAngle: 180,
                        center: ['50%', '75%']
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Strength',
                    innerSize: '50%',
                    data: [{name: 'Game Awarness',y: <?php echo $tact_details->game_awarness;?>},  
                           {name: 'Balance',y: <?php echo $tact_details->balance;?>}, 
                           {name: 'Pressing',y: <?php echo $tact_details->pressing;?>}, 
                           {name: 'Possesion',y: <?php echo $tact_details->possesion;?>}, 
                           {name: 'Adaptability',y: <?php echo $tact_details->adaptability;?>},
                           {name: 'Support',y: <?php echo $tact_details->support;?>},
                           {name: 'Decissions Making',y: <?php echo $tact_details->decissions_making;?>},
                           {name: 'Compactness',y: <?php echo $tact_details->compactness;?>},
                           {name: 'Transition',y: <?php echo $tact_details->transition;?>},
                           {name: 'Anticipation',y: <?php echo $tact_details->anticipation;?>},
                           {name: 'Overlaps', y: <?php echo $tact_details->overlaps;?>},
                           {name: 'Marking',y: <?php echo $tact_details->marking;?>},
                           {name: 'Recovery',y: <?php echo $tact_details->recovery;?>},
                           {name: 'Responsivness',y: <?php echo $tact_details->responsivness;?>},
                           {name: 'Covering',y: <?php echo $tact_details->covering;?>}
                        ]
                }]
            });
          });
  </script>

    <?php } else { ?>
          <h5> Don't have Tactical Rating </h5>

         <?php   } ?>

        </div>

        <!-- End Tactical Section -->



        <!-- Start Physical Section -->

  <div class="sub_section">
        <div class="sub_title"><h4>Physical</h4></div>

        <?php if(!empty($physical)){ ?>

            <div class="vital_con" id="physical_view">
                <div id="container_physical" style="min-width: 300px; height: 300px; max-width: 600px; margin: 0 auto"></div>

            </div>
    
      <script type="text/javascript">

                        $(function () {
                            $('#container_physical').highcharts({
                              colors :['#ff4323','#ff5436','#ff644a','#ff755d','#ff8671','#ff9785','#ffa798','#ffb8ac',
                                        '#ffc9c0','#ffdad3'],
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: 0,
                                    plotShadow: false
                                },
                                title: {
                                    text: 'Physical <br>'+ <?php echo $per_physical['percent'];?>+'%',
                                    align: 'center',
                                    verticalAlign: 'middle',
                                    y: 60
                                },
                                tooltip: {
                                    pointFormat: '{series.name}: <b>{point.y}/10</b>'
                                },
                                plotOptions: {
                                    pie: {
                                        dataLabels: {
                                            enabled: false,
                                            distance: -50,
                                            style: {
                                                fontWeight: 'bold',
                                                color: 'white',
                                                textShadow: '0px 1px 2px black'
                                            }
                                        },
                                        startAngle: -180,
                                        endAngle: 180,
                                        center: ['50%', '75%']
                                    }
                                },
                                series: [{
                                    type: 'pie',
                                    name: 'Strength',
                                    innerSize: '50%',
                                    data: [{name: 'Acceleration',y: <?php echo $physical->acceleration;?>},  
                                           {name: 'Coordination',y: <?php echo $physical->coordination;?>}, 
                                           {name: 'Jumping',y: <?php echo $physical->jumping;?>}, 
                                           {name: 'Strength',y: <?php echo $physical->strength;?>}, 
                                           {name: 'Quickness',y: <?php echo $physical->quickness;?>},
                                           {name: 'Agility',y: <?php echo $physical->agility;?>},
                                           {name: 'Reaction',y: <?php echo $physical->reaction;?>},
                                           {name: 'Flexibility',y: <?php echo $physical->flexibility;?>},
                                           {name: 'Power',y: <?php echo $physical->power;?>},
                                           {name: 'Basic Motor Skills',y: <?php echo $physical->basic_motor_skills;?>},
                                           {name: 'Balance', y: <?php echo $physical->balance;?>},
                                           {name: 'Speed',y: <?php echo $physical->speed;?>},
                                           {name: 'Endurance',y: <?php echo $physical->endurance;?>},
                                           {name: 'Mobility',y: <?php echo $physical->mobility;?>},
                                           {name: 'Explosivness',y: <?php echo $physical->explosivness;?>}
                                        ]
                                }]
                            });
                        });
       </script>


            <?php } else { ?>
                     <h5> Don't have Physical Rating </h5>
         <?php   } ?>

        </div>
        <!-- End Physical Section -->



        <!-- Start Psychosocial Section -->

        <div class="sub_section">

            <div class="sub_title"><h4>Psychosocial</h4>

            </div>

           

            <?php if(!empty($psy_details)){ ?>

            <div class="vital_con" id="psychosocial_view">

                 <div id="container_psy_details" style="min-width: 300px; height: 300px; max-width: 600px; margin: 0 auto"></div>

                   </div>
            
 <script type="text/javascript">
           $(function () {
              $('#container_psy_details').highcharts({
                  chart: {
                      plotBackgroundColor: null,
                      plotBorderWidth: 0,
                      plotShadow: false
                  },
                  title: {
                      text: 'Psychosocial <br>'+ <?php echo $per_psyhosocial['percent'];?>+'%',
                      align: 'center',
                      verticalAlign: 'middle',
                      y: 60
                  },
                  tooltip: {
                      pointFormat: '{series.name}: <b>{point.y}/10</b>'
                  },
                  plotOptions: {
                      pie: {
                          dataLabels: {
                              enabled: false,
                              distance: -50,
                              style: {
                                  fontWeight: 'bold',
                                  color: 'white',
                                  textShadow: '0px 1px 2px black'
                              }
                          },
                          startAngle: -180,
                          endAngle: 180,
                          center: ['50%', '75%']
                      }
                  },
                  series: [{
                      type: 'pie',
                      name: 'Strength',
                      innerSize: '50%',
                      data: [{name: 'Attitude',y: <?php echo $psy_details->attitude;?>},  
                             {name: 'Cooperation',y: <?php echo $psy_details->cooperation;?>}, 
                             {name: 'Passion',y: <?php echo $psy_details->passion;?>}, 
                             {name: 'Respect',y: <?php echo $psy_details->respect;?>}, 
                             {name: 'Trustworthiness',y: <?php echo $psy_details->trustworthiness;?>},
                             {name: 'Self Confidence',y: <?php echo $psy_details->self_confidence;?>},
                             {name: 'Communication',y: <?php echo $psy_details->communication;?>},
                             {name: 'Discipline',y: <?php echo $psy_details->discipline;?>},
                             {name: 'Leadership',y: <?php echo $psy_details->leadership;?>},
                             {name: 'Honesty',y: <?php echo $psy_details->honesty;?>},
                             {name: 'Competitivness', y: <?php echo $psy_details->competitivness;?>},
                             {name: 'Focus',y: <?php echo $psy_details->focus;?>},
                             {name: 'Vision',y: <?php echo $psy_details->vision;?>},
                             {name: 'Motivation',y: <?php echo $psy_details->motivation;?>}
                          ]
                  }]
              });
          });
  </script>


           <?php } else { ?>                     
                    <h5> Don't have Physical Rating </h5>
           <?php   } ?>
   
        </div>
 <script>
      $(document).ready(function(){
          $(".highcharts-container").css('oveflow','visible');
      });
</script>

<!-- End Psychosocial Section -->


</div>
 <!-- End Vital div -->