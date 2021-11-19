
    let darkMode = localStorage.getItem("darkMode");
    const darkModeToggle = document.querySelector('#flexSwitchCheckDefault');

    console.log(darkMode);


    const enableDarkMode = () => {
        document.body.classList.toggle("darkmode");
        localStorage.setItem('darkMode', 'enabled');
    };

    const disableDarkMode = () => {
        document.body.classList.toggle("darkmode");
        localStorage.setItem('darkMode', null);
    };

    if (darkMode === "enabled") {
        enableDarkMode();
    }

    darkModeToggle.addEventListener("click", () =>{
        darkMode = localStorage.getItem("darkMode");

        if (darkMode !== "enabled") {
            enableDarkMode();
        }else{
            disableDarkMode();
        }
    });



