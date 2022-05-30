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
                }
                
                if(darkMode === null){
                    localStorage.setItem('darkMode', 'closed');
                }
            
                darkModeToggle.addEventListener("click", () =>{
                    darkMode = localStorage.getItem("darkMode");
            
                    if (darkMode !== "enabled") {
                        enableDarkMode();
                    }else{
                        disableDarkMode();
                    }
                });
    
    



    

