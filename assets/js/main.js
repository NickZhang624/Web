document.addEventListener("DOMContentLoaded", function() {
    getTeamList();
    let team_id ='1';
    w3.getHttpObject(`/api/players/?team_id=${team_id}`, displayTeamPlayers);
    getTeamCoach();

})

async function getTeamList(){
    w3.getHttpObject("/api/teams", displayTeamList)
}

async function displayTeamList(data){
    await w3.displayObject("teams", data);
}


async function displayTeamPlayers(data){
    await w3.displayObject("players-grid", data);
}

async function getPlayers(e) {
    e.preventDefault();
    let team_id = e.target.dataset.id
    w3.getHttpObject(`/api/players/?team_id=${team_id}`, displayTeamPlayers)
    getTeamCoach(team_id)
}
async function getTeamCoach(team_id) {
    w3.getHttpObject(`/api/coach/?team_id=${team_id}`, displayCoach)
}
async function displayCoach(data) {
    await w3.displayObject("coach-panel", data);
    w3.hide("#player-panel");
    w3.show("#coach-panel");
}


async function getPlayer(e){
    e.preventDefault();
    let player_id = e.target.dataset.player_id
    w3.getHttpObject(`/api/players/?player_id=${player_id}`, displayPlayer)
}

async function displayPlayer(data) {
    await w3.displayObject("player-panel", data);
    w3.show("#player-panel");
    w3.hide("#coach-panel");
}

