// 隊伍費用動畫
function animateValue(id, start, end, duration) {
    let obj = document.getElementById(id);
    let range = end - start;
    let current = start;
    let increment = end > start ? Math.ceil(range / (duration / 50)) : Math.floor(range / (duration / 50));
    let stepTime = Math.abs(Math.floor(duration / (range / increment)));
    let timer = setInterval(function() {
        current += increment;
        if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
            current = end;
            clearInterval(timer);
        }
        obj.textContent = current;
    }, stepTime);
}

document.addEventListener("DOMContentLoaded", function() {
    let target = document.getElementById("amount");

    let observer = new IntersectionObserver(function(entries) {
        if (entries[0].isIntersecting) {
            animateValue("amount", 0, 5000, 2000); // 參數end可以調整金錢數值
            observer.unobserve(target); // 動畫開始後停止觀察
        }
    }, {threshold: 1}); // 元素進入視窗100%時觸發

    observer.observe(target);
});

