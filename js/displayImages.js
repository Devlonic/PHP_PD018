window.addEventListener("load", (e)=>{
    const imagesInp = document.getElementById("images");
    imagesInp.onchange=(e)=>{
        const images = e.target.files;
        const imagesContainer = document.getElementById("imagesContainer");
        imagesContainer.innerHTML = "";
        for (let i = 0, imageNum = 0; i < images.length / 3; i++) {
            let row = document.createElement("div");
            row.classList.add("row");
            for (let j = 0; imageNum < images.length && j < 3; j++, imageNum++) {
                let col = document.createElement("div");
                col.classList.add("col");
                col.style.height = "10rem";

                let card = document.createElement("div");
                card.classList.add("card")
                card.style.width = "8rem";


                let image = document.createElement("img");
                image.src = URL.createObjectURL(images[imageNum]);
                image.classList.add("card-img-top");

                card.appendChild(image);

                col.appendChild(card);
                row.appendChild(col);
            }
            imagesContainer.appendChild(row);
        }
    }
})