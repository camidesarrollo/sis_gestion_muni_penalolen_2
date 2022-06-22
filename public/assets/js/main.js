function bloquearPantalla(){

    /*	$.blockUI({
        theme: true,
        baseZ: 2000
    })*/
    
         $.blockUI(
             {
                 baseZ: 2000
             });
    
         /*$.blockUI({ css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: 'white', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .4, 
                color: 'white'
               
            } });*/
    }
    
    function desbloquearPantalla(){
        $.unblockUI();
    }