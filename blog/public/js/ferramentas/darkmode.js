                let darkMode = localStorage.getItem("darkMode");
                const darkModeToggle = document.querySelector('#flexSwitchCheckDefault');

                const enableDarkMode = () => {
                    document.body.classList.toggle("darkmode");
                    localStorage.setItem('darkMode', 'enabled');
                    
                };
            
                const disableDarkMode = () => {
                    document.body.classList.toggle("darkmode");
                    localStorage.setItem('darkMode', 'closed');
                };
            
                if (darkMode === "enabled") {
                    enableDarkMode();
                    $('#iconDarkMode').addClass('fad');
                    $('#iconDarkMode').addClass('fa-power-off');
                }
                
                if(darkMode === null){
                    localStorage.setItem('darkMode', 'closed');
                    $('#iconDarkMode').addClass('fad');
                    $('#iconDarkMode').addClass('fa-moon');
                }
            
                darkModeToggle.addEventListener("click", () =>{
                    darkMode = localStorage.getItem("darkMode");
                    
                    
            
                    if (darkMode !== "enabled") {
                        enableDarkMode();
                        $('#iconDarkMode').removeClass('fad');
                        $('#iconDarkMode').removeClass('fa-moon');
                        $('#iconDarkMode').addClass('fad');
                        $('#iconDarkMode').addClass('fa-power-off');

                    }else{
                        disableDarkMode();
                        $('#iconDarkMode').removeClass('fas');
                        $('#iconDarkMode').removeClass('fa-power-off');
                        $('#iconDarkMode').addClass('fad');
                        $('#iconDarkMode').addClass('fa-moon');
                    }
                });
    
    



    

