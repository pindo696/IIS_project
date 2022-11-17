function triggerModal(){
    import * as mdb from "bootstrap";
    const myModalEl = document.getElementById('exampleModal');
    const modal = new mdb.Modal(myModalEl);
    modal.toggle();
}


