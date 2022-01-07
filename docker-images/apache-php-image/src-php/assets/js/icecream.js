$(
    function () {
        console.log("loading ice creams");

        function loadIcecream() {
            $.getJSON("/api/icecream/", (icecreams) => {
                $(".dynamic-content").empty();
                content = "<ul class='w3-black'><p >" + icecreams.iceCreamBowls.length + " bowls : </p>";
                icecreams.iceCreamBowls.forEach(element => {
                    content += "<li>" + element + "</li>";
                });
                content += "</ul>";
                $(".dynamic-content").append(content);
            });
            
        }

        loadIcecream();
        setInterval(loadIcecream, 2000);
    }
)