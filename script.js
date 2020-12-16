window.addEventListener("load", initSite)
document.getElementById("saveBtn").addEventListener("click", setHoroscope)
document.getElementById("updateBtn").addEventListener("click", updateHoroscope)
document.getElementById("deleteBtn").addEventListener("click", deleteHoroscope) 

async function initSite() {
    getHoroscope()
}

async function getHoroscope() {
    let hsContainer = document.getElementById("container")
    let collectedDate = await makeRequest("./server/viewHoroscope.php", "GET", undefined)
    console.log(collectedDate) //loggar datum
    
    hsContainer.innerText = collectedDate //printar horoskop

    if(collectedDate == false) {
        hsContainer.innerText = "No session saved." + " " + "Please enter your birthdate correctly."
    }

}

async function setHoroscope() {
    let dateInput = document.getElementById("dateInput").value
    let hsContainer = document.getElementById("container")
    let body = new FormData()
    body.set("date", dateInput)
    let serverResponse = await makeRequest("./server/addHoroscope.php", "POST", body) 
    console.log(serverResponse)
   
    hsContainer.innerText = getHoroscope()

}

async function deleteHoroscope() {
    let hsContainer = document.getElementById("container")
    let deleteRequest = await makeRequest("./server/deleteHoroscope.php", "DELETE", undefined)

    if(hsContainer !== "") {
        hsContainer.innerText = "Your horoscope is gone..."
        console.log(deleteRequest)
    }

}

async function updateHoroscope() {
    let dateInput = document.getElementById("dateInput").value
    let hsContainer = document.getElementById("container") 
    let body = new FormData()
    body.set("date", dateInput)
    await makeRequest("./server/updateHoroscope.php", "POST", body)

    hsContainer.innerText = getHoroscope() //printar horoskop
}


async function makeRequest(path, method, body) { //Tar in 3 parametrar.
    try {
        let response = await fetch(path, {
            method, 
            body 
        })
        console.log(response)
        return await response.json()
    }   
        catch(e) {
        console.log(e) 
    }
}
