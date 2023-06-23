export default class MenuComponent
{
    isOpen = false;

    constructor()
    {
        this.btnMenu = $("#displayMenuIcon");
        this.navMenuContainer = $("#navigation_menu");
        this.navMenuContent = $($("#navigation_menu .nav_content")[0]);
        this.navItems = this.navMenuContent.children();

        this.addDefaultEvents();
    }

    addDefaultEvents = () => 
    {
        this.btnMenu.on("click", this.toggle);

        $(document).on("click", ev => {
            if(ev.target.tagName != "I" && !$(ev.target).hasClass("avatarImg"))
                this.close();
        });
    }

    open = () =>
    {
        this.navMenuContainer.animate(
            {
                left: "0",
                opacity: "1"
            }, 200
        )

        this.isOpen = true;
    }

    close = () =>
    {
        this.navMenuContainer.animate(
            {
                left: "-50%",
                opacity: 0
            }, 300
        )

        this.isOpen = false;
    }

    toggle = () =>
    {
        if(this.isOpen)
            this.close();
        else
            this.open();
    }

}