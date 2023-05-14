/**
* PHP Email Form Validation - v3.6
* URL: https://bootstrapmade.com/php-email-form/
* Author: BootstrapMade.com
*/

function caculate() {
    
    var name = document.getElementById("name").value;
    var normal_day = document.getElementById("normal_day").value;
    var abnormal_day = document.getElementById("abnormal_day").value;
    var level = document.getElementById("level").value;
    var road = document.getElementById("road").value;
    var terrain = document.getElementById("terrain").value;
    var plant = document.getElementById("plant").value;
    var energy = document.getElementById("energy").value;
    var water = document.getElementById("water").value;
    
    if(check(name, normal_day, abnormal_day, level, road, terrain, plant, energy, water)) {
        document.getElementById("store_result").disabled = false;
        var levelScore = Number(caculateLevel(level, road, terrain, plant));
        var dayScore = Number(calculateDay(normal_day, abnormal_day));
        var energyScore = Number(calculateEnergy(energy, water));
        var score = levelScore + dayScore + energyScore;
        var rank = calcuateRank(score);
        var msg =
        "路線名稱：" + name + "<br>路況分數：" + levelScore + "<br>天數分數：" + dayScore + "<br>體力分數：" + energyScore + "<br>總分：" + score + "<br>難度等級：" + rank ;
        document.querySelector('.result-message').innerHTML = msg;
        
    }     
    
}

function check(name, normal_day, abnormal_day, level, road, terrain, plant, energy, water){
            if(name == ""){
                alert("請填寫路線名稱");
                return false;
            }
            if(checkDay(normal_day, abnormal_day, water)){ 
                if(level == ""){
                    alert("請選擇路況分級");
                    return false;
                }
                if(road == ""){
                    alert("請選擇路跡/指標");
                    return false;
                }
                if(terrain == ""){
                    alert("請選擇地形");
                    return false;
                }
                if(plant == ""){
                    alert("請選擇植被");
                    return false;
                }
                if(energy == ""){
                    alert("請選擇體力");
                    return false;
                }
                return true;
            }
            
        }

function checkDay(normal_day, abnormal_day, water){

    var sum = Number(normal_day) + Number(abnormal_day);
    if(Number(normal_day) == 0 && Number(abnormal_day) == 0){
        alert("天數不得為0，請修改一下:)");
        return false;
    }
    if(Number(water) > sum){
        alert("背水天數不可能大於總天數喔，請你修改一下:)");
        return false;
    }
    return true;
    
}

function calculateDay(normal_day, abnormal_day){
    var score = 0;
    var maxAbnormalIndex = 9;
    var abnormalScore = [0, 10, 15, 20, 25, 30, 35, 40, 45, 50];

    if(normal_day == 1)
        score = 5;
    else if(normal_day >= 2 && normal_day <= 3)
        score = 10;
    else if(normal_day >= 4 && normal_day <= 5)
        score = 15;
    else if(normal_day >= 6 && normal_day <= 8)
        score = 20;
    else if(normal_day >= 9)
        score = 25;
    if(Number(abnormal_day) <= 9)    
        score += abnormalScore[Number(abnormal_day)];
    else
        score += abnormalScore[maxAbnormalIndex];
    return score;
}

function caculateLevel(level, road, terrain, plant){
    var score = 0;
    let level_score_array = [1, 11, 21, 26, 31, 36];
    score = (level_score_array[(Number(level))] + (Number(road) * 0.3 + Number(terrain) * 0.4 + Number(plant) * 0.3) * 2 ) * 1.5;
    return score.toFixed(0);
}

function calculateEnergy(energy,water){
    var score = energy * 7 + water * 2;
    return score;
}
function calcuateRank(score){
    var rank = "";
    if(score < 40)
        rank = "D";
    else if(score >= 40 && score < 60)
        rank = "C";
    else if(score >= 60 && score < 80)
        rank = "B";
    else if(score >= 80 && score < 100)
        rank = "A";
    else if(score >= 100 && score < 120)
        rank = "S";
    else if(score >= 120)
        rank = "S+";
    return rank;
}

// (function(){
//     "use strict";
    
//     let forms = document.querySelectorAll('.php-email-form');
//     forms.forEach( function(e) {
//         e.addEventListener('submit', function(event) {
//         event.preventDefault();
        
//         let thisForm = this;
//         var normal_day = document.getElementById("normal_day").value;
//         var abnormal_day = document.getElementById("abnormal_day").value;
//         var level = document.getElementById("level").value;
//         var road = document.getElementById("road").value;
//         var terrain = document.getElementById("terrain").value;
//         var plant = document.getElementById("plant").value;
//         var energy = document.getElementById("energy").value;
//         var water = document.getElementById("water").value;
        
//         if(checkDay(normal_day, abnormal_day, water)) {
//             var levelScore = Number(caculateLevel(level, road, terrain, plant));
//             var dayScore = Number(calculateDay(normal_day, abnormal_day));
//             var energyScore = Number(calculateEnergy(energy, water));
//             var score = levelScore + dayScore + energyScore;
//             var rank = calcuateRank(score);
//             var msg =
//             "路況分數：" + levelScore + "<br>天數分數：" + dayScore + "<br>體力分數：" + energyScore + "<br>總分：" + score + "<br>難度等級：" + rank ;
//             thisForm.querySelector('.result-message').innerHTML = msg;
//         }    
//         });
//     });

//     function checkDay(normal_day, abnormal_day, water){

//         var sum = Number(normal_day) + Number(abnormal_day);
//         if(Number(normal_day) == 0 && Number(abnormal_day) == 0){
//             alert("天數不得為0，請修改一下:)");
//             return false;
//         }
//         if(Number(water) > sum){
//             alert("背水天數不可能大於總天數喔，請你修改一下:)");
//             return false;
//         }
//         return true;
        
//     }

//     function calculateDay(normal_day, abnormal_day){
//         var score = 0;
//         var maxAbnormalIndex = 9;
//         var abnormalScore = [0, 10, 15, 20, 25, 30, 35, 40, 45, 50];

//         if(normal_day == 1)
//             score = 5;
//         else if(normal_day >= 2 && normal_day <= 3)
//             score = 10;
//         else if(normal_day >= 4 && normal_day <= 5)
//             score = 15;
//         else if(normal_day >= 6 && normal_day <= 8)
//             score = 20;
//         else if(normal_day >= 9)
//             score = 25;
//         if(Number(abnormal_day) <= 9)    
//             score += abnormalScore[Number(abnormal_day)];
//         else
//             score += abnormalScore[maxAbnormalIndex];
//         return score;
//     }

//     function caculateLevel(level, road, terrain, plant){
//         var score = 0;
//         let level_score_array = [1, 11, 21, 26, 31, 36];
//         score = (level_score_array[(Number(level))] + (Number(road) * 0.3 + Number(terrain) * 0.4 + Number(plant) * 0.3) * 2 ) * 1.5;
//         return score.toFixed(0);
//     }

//     function calculateEnergy(energy,water){
//         var score = energy * 7 + water * 2;
//         return score;
//     }
//     function calcuateRank(score){
//         var rank = "";
//         if(score < 40)
//             rank = "D";
//         else if(score >= 40 && score < 60)
//             rank = "C";
//         else if(score >= 60 && score < 80)
//             rank = "B";
//         else if(score >= 80 && score < 100)
//             rank = "A";
//         else if(score >= 100 && score < 120)
//             rank = "S";
//         else if(score >= 120)
//             rank = "S+";
//         return rank;
//     }
// })();
