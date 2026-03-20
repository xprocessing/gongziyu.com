// 初始化任务数组
let tasks = JSON.parse(localStorage.getItem('tasks')) || [];

// 初始化加载任务
window.onload = () => {
    renderTasks();
    document.getElementById('taskInput').addEventListener('keypress', (e) => {
        if(e.key === 'Enter') addTask();
    });
};

// 添加新任务
function addTask() {
    const input = document.getElementById('taskInput');
    const text = input.value.trim();
    
    if(text) {
        // 在任务对象中添加 dueTime 属性
        tasks.push({
          id: Date.now(),
          text,
          completed: false,
          dueTime: document.getElementById('taskTime').value
        });
        
        // 新增通知权限请求
        if (Notification.permission !== 'granted') {
          Notification.requestPermission();
        }
        
        // 新增定时检查函数
        function checkDueTasks() {
          tasks.forEach(task => {
            if (!task.completed && new Date(task.dueTime) <= new Date()) {
              // 在通知触发时添加声音
              const notificationSound = new Audio('data:audio/wav;base64,UklGRl9vT19XQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YU');
              new Notification('待办事项提醒', { 
                body: `${taskContent} - 时间到！`,
                icon: '/favicon.ico',
                vibrate: [200,100,200]
              });
              notificationSound.play();
            }
          });
        }
        
        // 每分钟检查一次
        setInterval(checkDueTasks, 60000);
        saveTasks();
        renderTasks();
        input.value = '';
    }
}

// 删除任务
function deleteTask(id) {
    tasks = tasks.filter(task => task.id !== id);
    saveTasks();
    renderTasks();
    
}

// 切换完成状态
function toggleComplete(id) {
    tasks = tasks.map(task => {
        if(task.id === id) {
            task.completed = !task.completed;
        }
        return task;
    });
    saveTasks();
    renderTasks();
}

// 保存到本地存储
function saveTasks() {
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

// 渲染任务列表
function renderTasks() {
    const list = document.getElementById('taskList');
    // 修正后的渲染模板
    list.innerHTML = tasks.map(task => `
      <li class="${task.completed ? 'completed' : ''}">
        <span onclick="toggleComplete(${task.id})">${task.text}</span>
        <span class="task-time">${new Date(task.dueTime).toLocaleString()}</span>
        <button class="delete-btn" onclick="deleteTask(${task.id})">删除</button>
      </li>
    `).join('');
}