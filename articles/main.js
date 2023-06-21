import MenuComponent from "../components/menu_side/main.js";

$(document).ready(() => {
    const profileAvatar = $("#avatarImg");

    const menu = new MenuComponent();

    function addListeners()
    {
        profileAvatar.on("click", menu.toggle);
        menu.navItems.on("click", menu.close);
    }

    function init()
    {
        addListeners();
    }

    init();

});