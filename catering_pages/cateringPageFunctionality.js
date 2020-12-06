function displayMenu(menuType)
{
    var menus = ["dessertDiv", "pastasDiv", "plattersDiv", "appetizersDiv", "saladsDiv", "buffetDiv", "grboardsDiv"];
    var chosenMenu;

    

    alert("WE ARE MAKING IT HERE");
    
    switch(menuType)
    {
        case "appetizers":
            chosenMenu = "appetizersDiv";
            break;
        case "platters":
            chosenMenu = "plattersDiv";
            break;
        case "pastas":
            chosenMenu = "pastasDiv";
            break;
        case "salads":
            chosenMenu = "saladsDiv";
            break;
        case "desserts":
            chosenMenu = "dessertDiv";
            break;
        case "buffet":
            chosenMenu = "buffetDiv";
            break;
        case "grboards":
            chosenMenu = "grboardsDiv";
            break;
    }

    document.getElementById(chosenMenu).style.display = "block";

}