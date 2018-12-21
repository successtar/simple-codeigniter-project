/** ********************************************** **
	@Author			Scartheme .
	@Last Update	April 23, 2017
*************************************************** **/

$(document).ready(function() {
"use script"
    SarahDatapp = {
        appinit: function() {
            SarahDatapp.HandleSidebartoggle();
            SarahDatapp.Handlelpanel();
            SarahDatapp.Handlelpanelmenu();
            SarahDatapp.Handlethemeoption();
            SarahDatapp.Handlesidebareffect();
            SarahDatapp.Handlesidebarposition();
            SarahDatapp.Handlecontentheight();
            SarahDatapp.Handlethemecolor();
			SarahDatapp.Handlenavigationtype();
			SarahDatapp.Handlesidebarside();
			SarahDatapp.Handleactivestatemenu();
			SarahDatapp.Handlethemelayout();
			SarahDatapp.Handlethemebackground();
			 

        },
		Handlethemebackground: function() {
            function setthemebgcolor() {
                $('#theme-color > a.theme-bg').on("click", function() {
                    $('body').attr("theme-bg", $(this).attr("sarah-themebg-type"));
                });
            };
			setthemebgcolor(); 
        },
		Handlethemelayout: function() {
			 $('#theme-layout').on("change", function() {
                if ($(this).val() == 'box-layout') {
                  $('body').attr("theme-layout", "box-layout");
                }else {
				 $('body').attr("theme-layout", "wide-layout");
				}
            });
        },
		Handleactivestatemenu: function() {
			 $(".panel-list li:not('.sarah-has-menu') > a").on("click", function() {
				if ($('body').attr("sarah-navigation-type") == "vertical" || $('body').attr("sarah-navigation-type") == "vertical-compact")   {
					if ($(this).closest('li.sarah-has-menu').length === 1){
						$(this).closest('.panel-list').find('li.active').removeClass('active');
						$(this).parent().addClass('active');
						$(this).parent().closest('.sarah-has-menu').addClass('active');
						$(this).parent('li').closest('li').closest('.sarah-has-menu').addClass('active');
					} else {
						$(this).closest('.panel-list').find('li.active').removeClass('active');
						$(this).closest('.panel-list').find('li.opened').removeClass('opened');
						$(this).closest('.panel-list').find('ul:visible').slideUp('fast');
						$(this).parent().addClass('active');
						 
					}
				}
			});
        }, 
		Handlesidebarside: function() {
			 $('#navigation-side').on("change", function() {
                if ($(this).val() == 'rightside') {
                  $('body').attr("sarah-nav-placement", "right"); 
				  $('body').attr("sarah-navigation-type", "vertical");
				  $('#sarahapp-wrapper').removeClass("compact-hmenu");
                }else {
				 $('body').attr("sarah-nav-placement", "left"); 
				 $('body').attr("sarah-navigation-type", "vertical");
				  $('#sarahapp-wrapper').removeClass("compact-hmenu");
				}
            });
        },
		Handlenavigationtype: function() {
			 $('#navigation-type').on("change", function() {
                if ($(this).val() == 'horizontal') {
                    $('body').attr("sarah-navigation-type", "horizontal");
					$('#sarahapp-wrapper').removeClass("compact-hmenu");
					$('#sarah-header, #sarahapp-container').removeClass("sarah-minimized-lpanel");
					$('body').attr("sarah-nav-placement", "left");
					$('#sarah-header').attr("sarah-color-type","logo-bg7");
					
                }else if  ($(this).val() == 'horizontal-compact'){
                    $('body').attr("sarah-navigation-type", "horizontal");
					$('#sarahapp-wrapper').addClass("compact-hmenu");
					$('#sarah-header, #sarahapp-container').removeClass("sarah-minimized-lpanel");
					$('body').attr("sarah-nav-placement", "left");
					$('#sarah-header').attr("sarah-color-type","logo-bg7");
                }else if  ($(this).val() == 'vertical-compact'){
                    $('body').attr("sarah-navigation-type", "vertical-compact");
					$('#sarahapp-wrapper').removeClass("compact-hmenu");
					$('#sarah-header, #sarahapp-container').addClass("sarah-minimized-lpanel");
					$('body').attr("sarah-nav-placement", "left"); 
                }else {
					$('body').attr("sarah-navigation-type", "vertical");
					$('#sarahapp-wrapper').removeClass("compact-hmenu");
					$('#sarah-header, #sarahapp-container').removeClass("sarah-minimized-lpanel");
					$('body').attr("sarah-nav-placement", "left"); 
				}
            });
        },
		
        Handlethemecolor: function() {

            function setheadercolor() {
                $('#theme-color > a.header-bg').on("click", function() {
                    $('#sarah-header > .sarah-right-header').attr("sarah-color-type", $(this).attr("sarah-color-type"));
                });
            };

            function setlpanelcolor() {
                $('#theme-color > a.lpanel-bg').on("click", function() {
                    $('#sarahapp-container').attr("sarah-color-type", $(this).attr("sarah-color-type"));
                });
            };

            function setllogocolor() {
                $('#theme-color > a.logo-bg').on("click", function() {
                    $('#sarah-header').attr("sarah-color-type", $(this).attr("sarah-color-type"));
                });
            };
            setheadercolor();
            setlpanelcolor();
            setllogocolor();
        },
        Handlecontentheight: function() {

            function setHeight() {
                var WH = $(window).height();
                var HH = $("#sarah-header").innerHeight();
                var FH = $("#footer").innerHeight();
                var contentH = WH - HH - FH - 2;
				var lpanelH = WH - HH - 2;
                $("#main-content ").css('min-height', contentH)
				 $(".inner-left-panel ").css('height', lpanelH)

            };
            setHeight();

            $(window).resize(function() {
                setHeight();
            });
        },
        Handlesidebarposition: function() {

            $('#sidebar-position').on("change", function() {
                if ($(this).val() == 'fixed') {
                    $('#sarah-left-panel,.sarah-left-header').attr("sarah-position-type", "fixed");
                } else {
                    $('#sarah-left-panel,.sarah-left-header').attr("sarah-position-type", "absolute");
                }
            });
        },
        Handlesidebareffect: function() {
            $('#leftpanel-effect').on("change", function() {
                if ($(this).val() == 'overlay') {
                    $('#sarah-header, #sarahapp-container').attr("sarah-lpanel-effect", "overlay");
                } else if ($(this).val() == 'push') {
                    $('#sarah-header, #sarahapp-container').attr("sarah-lpanel-effect", "push");
                } else {
                    $('#sarah-header, #sarahapp-container').attr("sarah-lpanel-effect", "shrink");
                }
            });

        },

        Handlethemeoption: function() {
            $('.selector-toggle > a').on("click", function() {
                $('#styleSelector').toggleClass('open')
            });

        },
        Handlelpanelmenu: function() {
            $('.sarah-has-menu > a').on("click", function() {
                var compactMenu = $(this).closest('.sarah-minimized-lpanel').length;
                if (compactMenu === 0) {
                    $(this).parent('.sarah-has-menu').parent('ul').find('ul:visible').slideUp('fast');
                    $(this).parent('.sarah-has-menu').parent('ul').find('.opened').removeClass('opened');
                    var submenu = $(this).parent('.sarah-has-menu').find('>.sarah-sub-menu');
                    if (submenu.is(':hidden')) {
                        submenu.slideDown('fast');
                        $(this).parent('.sarah-has-menu').addClass('opened');
                    } else {
                        $(this).parent('.sarah-has-menu').parent('ul').find('ul:visible').slideUp('fast');
                        $(this).parent('.sarah-has-menu').removeClass('opened');
                    }
                }
            });

        },
        HandleSidebartoggle: function() {
            $('.sarah-sidebar-toggle a').on("click", function() {
                if ($('#sarahapp-wrapper').attr("sarah-device-type") !== "phone") {
                    $('#sarahapp-container').toggleClass('sarah-minimized-lpanel');
                    $('#sarah-header').toggleClass('sarah-minimized-lpanel');
					if ($('body').attr("sarah-navigation-type") !== "vertical-compact") {
						$('body').attr("sarah-navigation-type", "vertical-compact"); 
					}else{
						$('body').attr("sarah-navigation-type", "vertical"); 
					}
                } else {
                    if (!$('#sarahapp-wrapper').hasClass('sarah-hide-lpanel')) {
                        $('#sarahapp-wrapper').addClass('sarah-hide-lpanel');
                    } else {
                        $('#sarahapp-wrapper').removeClass('sarah-hide-lpanel');
                    }
                }
            });

        },
        Handlelpanel: function() {

            function Responsivelpanel() {
                
				var totalwidth = $(window)[0].innerWidth;
                if (totalwidth >= 768 && totalwidth <= 1024) {
                    $('#sarahapp-wrapper').attr("sarah-device-type", "tablet");
                    $('#sarah-header, #sarahapp-container').addClass('sarah-minimized-lpanel');
					$('li.theme-option select').attr('disabled', false);
                } else if (totalwidth < 768) {
                    $('#sarahapp-wrapper').attr("sarah-device-type", "phone");
                    $('#sarah-header, #sarahapp-container').removeClass('sarah-minimized-lpanel');
					$('li.theme-option select').attr('disabled', 'disabled');
                } else {
					if ($('body').attr("sarah-navigation-type") !== "vertical-compact") {
						$('#sarahapp-wrapper').attr("sarah-device-type", "desktop");
						$('#sarah-header, #sarahapp-container').removeClass('sarah-minimized-lpanel');
						$('li.theme-option select').attr('disabled', false);
					}else {
						$('#sarahapp-wrapper').attr("sarah-device-type", "desktop");
						$('#sarah-header, #sarahapp-container').addClass('sarah-minimized-lpanel');
						$('li.theme-option select').attr('disabled', false);	
						
					}
                }
            }
            Responsivelpanel();
            $(window).resize(Responsivelpanel);

        },

    };
    SarahDatapp.appinit();
});