function displayMenu(menuType)
{
    var menus = ["dessertDiv", "pastasDiv", "plattersDiv", "appetizersDiv", "saladsDiv", "buffetDiv", "grboardsDiv"];
    var selections = ["appetizers", "platters", "pastas", "salads", "desserts", "buffet", "grboards"]
    var chosenMenu;

    if(document.getElementById("infoDiv").style.display == "block")
    {
        document.getElementById("infoDiv").style.display == "none";
    }

    hideElements(menus);
    removeUnderline(selections, menuType);
    
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
function hideElements(divs)
{
    divs.forEach(element => {
        if(document.getElementById(element).style.display == "block")
        {
            document.getElementById(element).style.display = "none";
        }
    });
}

function removeUnderline(selections, menuType)
{
    selections.forEach(element => {
        if(element ==  menuType)
        {
            document.getElementById(element).style.textDecoration = "underline";
        }
        else
        {
            document.getElementById(element).style.textDecoration = "none";
        }
    });
}