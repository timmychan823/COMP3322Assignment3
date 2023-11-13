var custom = false
var whichOneIsClicked 

function drag(event){
    event.dataTransfer.setData("dragging_component",event.target.id)
}

function drop(event){
    if (event.target.className == "Hidden"||event.target.className == "Visible"){
        event.preventDefault()
        var data = event.dataTransfer.getData("dragging_component")
        var clone = document.getElementById(data).cloneNode(true)
        document.getElementById(data).remove()
        event.target.parentNode.insertBefore(clone,event.target.nextSibling)
        event.target.style.borderStyle = 'dashed'
        event.target.style.borderWidth = '1px' 
        event.target.style.borderColor= 'red'
    }
}

function allow(event){
    if (event.target.className == "Hidden"||event.target.className == "Visible"){
        event.preventDefault()
        event.target.style.borderStyle= 'solid'
        event.target.style.borderWidth ='5px'
        event.target.style.borderColor = 'pink'
    }
}

function notDrop(event){
    if (event.target.className == "Hidden"||event.target.className == "Visible"){
        event.preventDefault()
        event.target.style.borderStyle = 'dashed'
        event.target.style.borderWidth = '1px' 
        event.target.style.borderColor= 'red'
    }

}

function notEyeIsClicked(){

    whichOneIsClicked = [null,null]
}

function hide(event){
    if (event.target.parentNode.className=="Hidden"){
        event.target.parentNode.className="Visible"
        whichOneIsClicked=[event.target.parentNode,'first']

    }else{
        event.target.parentNode.className="Hidden"
        whichOneIsClicked=[event.target.parentNode,'last']
        
    }
}

window.onload=()=>{
    var eyeButtons=$('#container>div>p+img')
    for(var i=0;i<eyeButtons.length;i++){
        eyeButtons[i].style.display = 'None' 
    }

    $("#container").html("<p id=saveOrCustomButton>Custom</p>"+$("#container").html())
    $("#saveOrCustomButton").on("click",function(){
        if (custom == false){
            custom=true

            $("#container div").css('display','Inline-block')
            $('#container div').css("border-style","dashed").css("border-color","red").css("border-width","1px")

            var blocks=$('#container>div')
            
            for(var i=0;i<blocks.length;i++){
                blocks[i].setAttribute('draggable','true')
         
            }

            var eyeButtons=$('#container>div>p+img')

            for(var i=0;i<eyeButtons.length;i++){
                eyeButtons[i].style.display = 'Inline-block' 

            }

            $("#container").on("click",function(){
                if (whichOneIsClicked[1]=="first"){
                    var clone = whichOneIsClicked[0].cloneNode(true)
                    this.insertBefore(clone,this.firstChild)
                    whichOneIsClicked[0].remove()

                }else if (whichOneIsClicked[1]=="last"){
                    var clone = whichOneIsClicked[0].cloneNode(true)
                    this.insertBefore(clone,null)
                    whichOneIsClicked[0].remove()
                }

                whichOneIsClicked = [null, null]
                
            })

            $(this).text("Save")

        }else{
          
            //Task to do: send the user preference back to server using fetch operation

            var blocks=$('#container>div')

            var visibleBlocks = $(".Visible")

            var order = ""

            for(var i=0;i<visibleBlocks.length;i++){
                order = order+visibleBlocks[i].id
            }

            document.cookie = "order="+order

            fetch("index.php",{method: "PUT"}) //working on this
            .then(response => {
               console.log(response.status)
            })
            .catch(err=>{console.log("Cant send error")})

            //ends here*/
            
            for(var i=0;i<blocks.length;i++){
                blocks[i].setAttribute('draggable','false')
              
            }
            $(".Hidden").css('display','None')
            $("#container>div>p+img").css('display','None')
            $('#container div').css("border","None")
            
            custom=false
            $(this).text("Custom")
        }
        whichOneIsClicked = [null, null]

    })
}
