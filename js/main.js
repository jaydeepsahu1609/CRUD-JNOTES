$(document).ready(function () {
    $('#notesTable').DataTable();
});

let btns = document.getElementsByClassName("editnotes");
Array.from(btns).forEach(btn => {
    btn.addEventListener("click", (e) => {
        let id = e.target.parentNode.id;
        let tr = e.target.parentNode.parentNode.parentNode;
        let title = tr.getElementsByTagName("td")[0].innerText.trim();
        let desc = tr.getElementsByTagName("td")[1].innerText.trim();

        document.getElementById("idEdit").value = id;
        document.getElementById("titleEdit").value = title;
        document.getElementById("descriptionEdit").value = desc;

        document.getElementById("editmodaltoggle").click();
    })
});

let dbtns = document.getElementsByClassName("deletenotes");
Array.from(dbtns).forEach(dbtn => {
    dbtn.addEventListener("click", (e) => {
        let id = (e.target.parentNode.id).substr(1,);
        let tr = e.target.parentNode.parentNode.parentNode;
        let title = tr.getElementsByTagName("td")[0].innerText.trim();
        let desc = tr.getElementsByTagName("td")[1].innerText.trim();

        if (confirm("Are you sure? Note once deleted cannot be rolled back!!")) {
            document.getElementById("idEdit").value = id;
            document.getElementById("titleEdit").value = title;
            document.getElementById("descriptionEdit").value = desc;

            window.location = "index.php?delete=" + id;
            // TO DO : 
            // 1     create a form and use post for submitting the form : resolve a security loop-hole
            //       remove this location = 
            // 2     url sends the id
            // 3     user authentication system
        }
    })
});