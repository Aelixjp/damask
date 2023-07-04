export default class LoadingComponent
{
    constructor()
    {
        this.loading = $("#overlay_spinner");
    }

    show()
    {
        $(this.loading).removeClass("d-none");
    }

    hide()
    {
        $(this.loading).addClass("d-none");
    }

    toggle()
    {
        $(this.loading).toggleClass("d-none");
    }
    
}