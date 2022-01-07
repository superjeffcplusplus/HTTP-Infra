$(
    function () {
        console.log("loading icecreams");

        function loadIcecream() {
            $.getJSON("/api/icecream/", (icecreams) => {
                console.log(icecreams);
                
            });
            
        }

        loadIcecream();
    }
)