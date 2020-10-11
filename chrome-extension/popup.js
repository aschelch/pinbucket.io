console.log('PinBucket.io extension loaded');

var appUrl = "https://www.pinbucket.io";

document.addEventListener('DOMContentLoaded', function() {

	var homeButton = document.getElementById('home');
	var loadingIcon = document.getElementById('loading');
	var usernameSpan = document.getElementById('username');
	var shareButton = document.getElementById('share');
    var teamsSelect = document.getElementById('teams');
    var linkInput = document.getElementById('link');

    function setUsername(username){
        usernameSpan.innerHTML = username || "";
        chrome.storage.sync.set({username: username});
    }

    function setTeamList(list){
        chrome.storage.sync.set({teams: list});
        teamsSelect.innerHTML = "";
        list.forEach(element => {
            var opt = document.createElement("option");
            opt.value = element.id;
            opt.text = element.name;
            teamsSelect.add(opt);
        });
        teamsSelect.value = lastTeamSelected;
    }

    // Display value in cache while requesting app
	chrome.storage.sync.get("username", function(result) {
        setUsername(result["username"]);
    });
    
    chrome.storage.sync.get("teams", function(result) {
        setTeamList(result['teams']);
    });

    chrome.storage.sync.get("lastTeamSelected", function(result) {
        lastTeamSelected = result["lastTeamSelected"];
        teamsSelect.value = lastTeamSelected;
    });

    var token;
    var lastTeamSelected;
    var xhr = new XMLHttpRequest();

    loadingIcon.style.display = "inline";


    // Load current user data
    xhr.open("GET", appUrl+"/home", true);
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            var page = xhr.responseText;


            if(xhr.responseURL == appUrl+"/login"){
                loadingIcon.style.display = "none";
                setUsername("Not connected");
                setTeamList([]);
                return;
            }

            // Fetch username
            result = page.match(/>(.*)<span class="caret">/)
            setUsername(result[1].trim());

            // Fetch team list
            teamsResults = [...page.matchAll(/data-team-id="([0-9]+)">(.*)<\/a>/g)];
            var teams = [];
            for (let index = 0; index < teamsResults.length; index++) {
                const element = teamsResults[index];
                teams.push({id:element[1], name:element[2]});
            }
            setTeamList(teams);

            // Fetch token
            result = page.match(/<input type="hidden" name="_token" value="(.*)">/);
            token = result[1];

            shareButton.removeAttribute("disabled");
            shareButton.innerHTML = "Share the link";
            loadingIcon.style.display = "none";
        }
    }
    xhr.send();

    chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
        linkInput.setAttribute('value', tabs[0].url);
    });

    homeButton.addEventListener('click', function(){
        chrome.tabs.create({ url: appUrl });
    });

    usernameSpan.addEventListener('click', function(){
        chrome.tabs.create({ url: appUrl+"/login" });
    });

	shareButton.addEventListener('click', function() {

        var link = linkInput.value;
        var team = teamsSelect.options[teamsSelect.selectedIndex].value;


        shareButton.setAttribute("disabled", "disabled");
        shareButton.innerHTML = "Sharing the link...";

        chrome.storage.sync.set({lastTeamSelected: team});

        xhr.open("POST", appUrl+"/link", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                window.close();
            }
        }
        xhr.send("url="+link+"&team_id="+team+"&_token="+token);
        
    });

});
