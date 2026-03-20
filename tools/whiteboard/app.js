const canvas = document.getElementById('whiteboard');
const ctx = canvas.getContext('2d');
let isDrawing = false;
let lastX = 0;
let lastY = 0;

// 自适应画布尺寸
function resizeCanvas() {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
}
window.addEventListener('resize', resizeCanvas);
resizeCanvas();

// 绘图属性配置
ctx.lineJoin = 'round';
ctx.lineCap = 'round';

// 工具事件监听
document.getElementById('colorPicker').addEventListener('input', (e) => {
  ctx.strokeStyle = e.target.value;
});

document.getElementById('brushSize').addEventListener('input', (e) => {
  ctx.lineWidth = e.target.value;
  document.getElementById('sizeDisplay').textContent = `${e.target.value}px`;
});

document.getElementById('eraser').addEventListener('click', () => {
  ctx.strokeStyle = '#ffffff';
  ctx.lineWidth = 20;
});

// 绘图功能实现
function startDrawing(e) {
  isDrawing = true;
  [lastX, lastY] = [e.clientX || e.touches[0].clientX, e.clientY || e.touches[0].clientY];
}

function draw(e) {
  if (!isDrawing) return;
  
  ctx.beginPath();
  ctx.moveTo(lastX, lastY);
  ctx.lineTo(e.clientX || e.touches[0].clientX, e.clientY || e.touches[0].clientY);
  ctx.stroke();
  
  [lastX, lastY] = [e.clientX || e.touches[0].clientX, e.clientY || e.touches[0].clientY];
}

// 事件监听器
canvas.addEventListener('mousedown', startDrawing);
canvas.addEventListener('mousemove', draw);
canvas.addEventListener('mouseup', () => isDrawing = false);
canvas.addEventListener('mouseout', () => isDrawing = false);

canvas.addEventListener('touchstart', startDrawing);
canvas.addEventListener('touchmove', draw);
canvas.addEventListener('touchend', () => isDrawing = false);