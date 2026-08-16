@extends('layouts.app')

@section('title', 'Trợ Lý AI Tìm Việc - JOB SEARCH')

@section('content')
<div class="assistant-page-wrapper py-4" style="background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%); min-height: 85vh;">
    <div class="container-fluid container-xl">

        <!-- Top Banner -->
        <div class="card border-0 shadow-sm rounded-4 mb-4 text-white overflow-hidden" 
             style="background: linear-gradient(135deg, #0C3149 0%, #1a4f75 60%, #dc3545 100%);">
            <div class="card-body p-4 p-md-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-danger px-3 py-1 rounded-pill fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                            AI Job Matcher
                        </span>
                        <span class="badge bg-white text-dark px-2.5 py-1 rounded-pill fw-semibold" style="font-size: 11px;">
                            ✨ Gemini 2.5 Flash
                        </span>
                    </div>
                    <h1 class="h3 fw-bold mb-2 text-white">
                        <i class="fa-solid fa-robot text-danger me-2"></i>Trợ Lý AI Tìm Việc Thông Minh
                    </h1>
                    <p class="mb-0 text-white-50 fs-6">
                        Tự động phân tích nhu cầu, tìm kiếm cơ hội việc làm chuẩn xác theo vị trí, mức lương và khu vực từ cơ sở dữ liệu.
                    </p>
                </div>
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <button id="resetChatBtn" class="btn btn-outline-light rounded-pill px-3 py-2 fw-semibold btn-sm shadow-sm" title="Bắt đầu lại cuộc trò chuyện">
                        <i class="fa-solid fa-rotate-right me-1"></i> Làm Mới Hội Thoại
                    </button>
                    <a href="{{ route('homepage') }}" class="btn btn-light text-primary rounded-pill px-3 py-2 fw-semibold btn-sm shadow-sm">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> Khám Phá Tất Cả Việc Làm
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Split Workspace -->
        <div class="row g-4">
            
            <!-- LEFT COLUMN: Interactive AI Chat Box (7 cols) -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 h-100 d-flex flex-column" style="background: #ffffff; min-height: 650px;">
                    
                    <!-- Chat Header -->
                    <div class="card-header bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center rounded-top-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="position-relative">
                                <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 44px; height: 44px; font-size: 20px;">
                                    <i class="fa-solid fa-robot"></i>
                                </div>
                                <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-1" style="width: 12px; height: 12px;"></span>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Trợ Lý Ảo JOB SEARCH</h6>
                                <small class="text-muted"><i class="fa-solid fa-circle text-success me-1" style="font-size: 8px;"></i>Đang sẵn sàng kết nối việc làm</small>
                            </div>
                        </div>
                        <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1 fw-bold">
                            Tư Vấn Trực Tuyến
                        </span>
                    </div>

                    <!-- Chat Message Area -->
                    <div id="chatMessages" class="card-body p-4 flex-grow-1 overflow-auto" style="max-height: 480px; background-color: #f8fafc;">
                        <!-- Messages will be rendered dynamically via JS -->
                    </div>

                    <!-- Typing indicator -->
                    <div id="typingIndicator" class="px-4 py-2 bg-light d-none">
                        <div class="d-inline-flex align-items-center gap-1.5 bg-white border rounded-pill px-3 py-1.5 shadow-sm">
                            <small class="text-muted me-1 fw-semibold">AI đang phân tích yêu cầu</small>
                            <span class="spinner-grow spinner-grow-sm text-danger" style="width: 6px; height: 6px;" role="status"></span>
                            <span class="spinner-grow spinner-grow-sm text-danger" style="width: 6px; height: 6px; animation-delay: 0.15s;" role="status"></span>
                            <span class="spinner-grow spinner-grow-sm text-danger" style="width: 6px; height: 6px; animation-delay: 0.3s;" role="status"></span>
                        </div>
                    </div>

                    <!-- Input Box & Quick Action Area -->
                    <div class="card-footer bg-white border-top p-3 rounded-bottom-4">
                        <form id="chatForm" class="d-flex gap-2" onsubmit="return false;">
                            <input type="text" id="userInput" class="form-control rounded-pill px-3.5 py-2.5 shadow-none border" 
                                   placeholder="Ví dụ: Tìm việc Lập trình viên Laravel tại Hải Phòng, lương từ 15 triệu..." 
                                   autocomplete="off" style="font-size: 14.5px;">
                            <button type="submit" id="sendBtn" class="btn btn-danger rounded-pill px-4 fw-bold d-flex align-items-center gap-1 shadow-sm">
                                <span>Gửi</span>
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            <!-- RIGHT COLUMN: Real-time Criteria Tracker & Live Job Matches (5 cols) -->
            <div class="col-lg-5">
                <div class="d-flex flex-column gap-4">

                    <!-- Panel 1: Live Criteria Status Tracker -->
                    <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                                <i class="fa-solid fa-sliders text-danger"></i>
                                Tiêu Chí Việc Làm Đã Thu Thập
                            </h6>
                            <span id="completionRateText" class="badge bg-secondary rounded-pill px-2.5 py-1">
                                0% Hoàn thành
                            </span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="progress rounded-pill mb-3" style="height: 8px; background-color: #edf2f7;">
                            <div id="completionBar" class="progress-bar bg-danger progress-bar-striped progress-bar-animated rounded-pill" 
                                 role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <!-- Criteria Badges Grid -->
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="p-2.5 rounded-3 border bg-light h-100 text-center">
                                    <small class="text-muted d-block mb-1"><i class="fa-solid fa-briefcase text-primary me-1"></i>Vị Trí</small>
                                    <span id="paramPosition" class="fw-bold text-dark text-truncate d-block" style="font-size: 13px;" title="Chưa xác định">
                                        Chưa có
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2.5 rounded-3 border bg-light h-100 text-center">
                                    <small class="text-muted d-block mb-1"><i class="fa-solid fa-money-bill-wave text-success me-1"></i>Mức Lương</small>
                                    <span id="paramSalary" class="fw-bold text-success text-truncate d-block" style="font-size: 13px;" title="Chưa xác định">
                                        Chưa có
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2.5 rounded-3 border bg-light h-100 text-center">
                                    <small class="text-muted d-block mb-1"><i class="fa-solid fa-location-dot text-danger me-1"></i>Địa Điểm</small>
                                    <span id="paramLocation" class="fw-bold text-dark text-truncate d-block" style="font-size: 13px;" title="Chưa xác định">
                                        Chưa có
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2.5 rounded-3 border bg-light h-100 text-center">
                                    <small class="text-muted d-block mb-1"><i class="fa-solid fa-clock text-warning me-1"></i>Hình Thức</small>
                                    <span id="paramJobType" class="fw-bold text-dark text-truncate d-block" style="font-size: 13px;" title="Chưa xác định">
                                        Chưa có
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panel 2: Live Matched Jobs List -->
                    <div id="matchedJobsPanel" class="card border-0 shadow-sm rounded-4 bg-white p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                                <i class="fa-solid fa-fire text-danger"></i>
                                Việc Làm Phù Hợp Nhất (<span id="matchedCount">0</span>)
                            </h6>
                            <span class="badge bg-danger rounded-pill px-2.5 py-1" style="font-size: 11px;">
                                Dữ Liệu Thực Tế
                            </span>
                        </div>

                        <!-- Job List Container -->
                        <div id="matchedJobsList" class="d-flex flex-column gap-3">
                            <!-- Placeholder empty state -->
                            <div class="text-center py-5 text-muted">
                                <div class="rounded-circle bg-light d-inline-flex p-3 mb-2">
                                    <i class="fa-solid fa-clipboard-question fa-2x text-secondary"></i>
                                </div>
                                <p class="mb-1 fw-semibold text-dark">Chưa có kết quả gợi ý</p>
                                <small>Hãy trò chuyện với AI ở khung bên trái để nhận danh sách công việc phù hợp nhé!</small>
                            </div>
                        </div>
                    </div>

                    <!-- Panel 3: Alternative / Related Suggestions -->
                    <div id="altJobsPanel" class="card border-0 shadow-sm rounded-4 bg-white p-4 d-none">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                                <i class="fa-solid fa-lightbulb text-warning"></i>
                                Có Thể Bạn Cũng Quan Tâm
                            </h6>
                        </div>

                        <!-- Alternative list -->
                        <div id="altJobsList" class="d-flex flex-column gap-2.5">
                            <!-- Injected dynamically -->
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

<!-- CSRF Meta Tag -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
/* Custom animations & chat bubble styles */
.chat-bubble {
    max-width: 85%;
    padding: 12px 18px;
    border-radius: 18px;
    font-size: 14.5px;
    line-height: 1.6;
    word-break: break-word;
    animation: fadeIn 0.3s ease-in-out;
}

.chat-bubble-ai {
    background-color: #ffffff;
    color: #1e293b;
    border-bottom-left-radius: 4px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.03);
}

.chat-bubble-user {
    background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
    color: #ffffff;
    border-bottom-right-radius: 4px;
    box-shadow: 0 4px 10px rgba(220, 53, 69, 0.25);
}

.quick-reply-btn {
    font-size: 12.5px;
    padding: 6px 14px;
    border-radius: 20px;
    background-color: #fee2e2;
    color: #b91c1c;
    border: 1px solid #fecaca;
    transition: all 0.2s ease;
    cursor: pointer;
    font-weight: 500;
}

.quick-reply-btn:hover {
    background-color: #dc3545;
    color: #ffffff;
    border-color: #dc3545;
    transform: translateY(-2px);
    box-shadow: 0 2px 6px rgba(220, 53, 69, 0.25);
}

.job-card-item {
    transition: all 0.25s ease;
    border: 1px solid #edf2f7;
}

.job-card-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.06) !important;
    border-color: #fca5a5 !important;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const chatMessages = document.getElementById("chatMessages");
    const chatForm = document.getElementById("chatForm");
    const userInput = document.getElementById("userInput");
    const sendBtn = document.getElementById("sendBtn");
    const typingIndicator = document.getElementById("typingIndicator");
    const resetChatBtn = document.getElementById("resetChatBtn");

    // Tracker UI Elements
    const paramPosition = document.getElementById("paramPosition");
    const paramSalary = document.getElementById("paramSalary");
    const paramLocation = document.getElementById("paramLocation");
    const paramJobType = document.getElementById("paramJobType");
    const completionBar = document.getElementById("completionBar");
    const completionRateText = document.getElementById("completionRateText");

    // Jobs List Container
    const matchedJobsList = document.getElementById("matchedJobsList");
    const matchedCount = document.getElementById("matchedCount");
    const altJobsPanel = document.getElementById("altJobsPanel");
    const altJobsList = document.getElementById("altJobsList");

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Conversation state
    let conversationHistory = [];
    let criteriaState = {
        position: null,
        salary: null,
        location: null,
        job_type: null
    };

    // Initial greeting
    const initialGreeting = {
        sender: 'ai',
        text: 'Xin chào bạn! Tôi là Trợ Lý AI Tìm Việc của JOB SEARCH. Tôi ở đây để hỗ trợ bạn kết nối với những công việc chất lượng và phù hợp nhất từ cơ sở dữ liệu hệ thống.\n\nBạn đang muốn tìm kiếm vị trí công việc nào (hoặc lĩnh vực/kỹ năng gì) thế ạ?',
        quickReplies: [
            'Lập trình viên Laravel',
            'Frontend ReactJS',
            'Nhân viên Kinh doanh',
            'Kế toán tổng hợp',
            'Hà Nội',
            'Hải Phòng'
        ]
    };

    function initChat() {
        conversationHistory = [
            {
                role: 'model',
                parts: [{ text: initialGreeting.text }]
            }
        ];

        criteriaState = {
            position: null,
            salary: null,
            location: null,
            job_type: null
        };

        updateTrackerUI();
        chatMessages.innerHTML = '';
        renderMessage('ai', initialGreeting.text, initialGreeting.quickReplies);

        matchedJobsList.innerHTML = `
            <div class="text-center py-5 text-muted">
                <div class="rounded-circle bg-light d-inline-flex p-3 mb-2">
                    <i class="fa-solid fa-clipboard-question fa-2x text-secondary"></i>
                </div>
                <p class="mb-1 fw-semibold text-dark">Chưa có kết quả gợi ý</p>
                <small>Hãy trò chuyện với AI ở khung bên trái để nhận danh sách công việc phù hợp nhé!</small>
            </div>
        `;
        matchedCount.innerText = '0';
        altJobsPanel.classList.add('d-none');
        altJobsList.innerHTML = '';
    }

    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function renderMessage(sender, text, quickReplies = []) {
        const msgWrapper = document.createElement("div");
        msgWrapper.className = `d-flex mb-3.5 ${sender === 'user' ? 'justify-content-end' : 'justify-content-start'}`;

        let html = '';
        if (sender === 'ai') {
            html += `
                <div class="d-flex align-items-start gap-2 max-w-100">
                    <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" 
                         style="width: 32px; height: 32px; font-size: 14px;">
                        <i class="fa-solid fa-robot"></i>
                    </div>
                    <div>
                        <div class="chat-bubble chat-bubble-ai">
                            ${formatText(text)}
                        </div>
                        ${quickReplies && quickReplies.length > 0 ? `
                            <div class="d-flex flex-wrap gap-1.5 mt-2">
                                ${quickReplies.map(reply => `<button type="button" class="quick-reply-btn" data-reply="${escapeHtml(reply)}">${escapeHtml(reply)}</button>`).join('')}
                            </div>
                        ` : ''}
                    </div>
                </div>
            `;
        } else {
            html += `
                <div class="chat-bubble chat-bubble-user">
                    ${escapeHtml(text)}
                </div>
            `;
        }

        msgWrapper.innerHTML = html;
        chatMessages.appendChild(msgWrapper);

        // Bind quick reply buttons
        msgWrapper.querySelectorAll(".quick-reply-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                const replyText = this.getAttribute("data-reply");
                sendMessage(replyText);
            });
        });

        scrollToBottom();
    }

    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function formatText(text) {
        if (!text) return '';
        return escapeHtml(text).replace(/\n/g, '<br>');
    }

    function updateTrackerUI() {
        paramPosition.innerText = criteriaState.position || 'Chưa có';
        paramPosition.title = criteriaState.position || 'Chưa có';

        if (criteriaState.salary) {
            let formatted = criteriaState.salary;
            if (typeof criteriaState.salary === 'number' && criteriaState.salary >= 1000000) {
                formatted = (criteriaState.salary / 1000000) + ' Triệu/tháng';
            }
            paramSalary.innerText = formatted;
            paramSalary.title = formatted;
        } else {
            paramSalary.innerText = 'Chưa có';
            paramSalary.title = 'Chưa có';
        }

        paramLocation.innerText = criteriaState.location || 'Chưa có';
        paramLocation.title = criteriaState.location || 'Chưa có';

        paramJobType.innerText = criteriaState.job_type || 'Chưa có';
        paramJobType.title = criteriaState.job_type || 'Chưa có';

        let filled = 0;
        if (criteriaState.position) filled++;
        if (criteriaState.salary) filled++;
        if (criteriaState.location) filled++;
        if (criteriaState.job_type) filled++;

        const percent = Math.round((filled / 4) * 100);
        completionBar.style.width = percent + '%';
        completionBar.setAttribute('aria-valuenow', percent);
        completionRateText.innerText = percent + '% Hoàn thành';

        if (percent >= 75) {
            completionBar.className = 'progress-bar bg-success progress-bar-striped progress-bar-animated rounded-pill';
            completionRateText.className = 'badge bg-success rounded-pill px-2.5 py-1';
        } else if (percent >= 50) {
            completionBar.className = 'progress-bar bg-primary progress-bar-striped progress-bar-animated rounded-pill';
            completionRateText.className = 'badge bg-primary rounded-pill px-2.5 py-1';
        } else {
            completionBar.className = 'progress-bar bg-danger progress-bar-striped progress-bar-animated rounded-pill';
            completionRateText.className = 'badge bg-danger rounded-pill px-2.5 py-1';
        }
    }

    function renderJobList(matchedJobs, alternativeJobs) {
        if (matchedJobs && matchedJobs.length > 0) {
            matchedCount.innerText = matchedJobs.length;
            let html = '';
            matchedJobs.forEach(job => {
                html += `
                    <div class="card job-card-item rounded-3 p-3 shadow-sm bg-white">
                        <div class="d-flex gap-3 align-items-start">
                            <img src="${job.company_avatar}" alt="${escapeHtml(job.company_name)}" 
                                 class="rounded-3 border flex-shrink-0 object-fit-cover shadow-xs" style="width: 52px; height: 52px;"
                                 onerror="this.src='/image/logo-jobsearch.png'">
                            <div class="flex-grow-1 min-w-0">
                                <div class="d-flex justify-content-between align-items-center gap-2 mb-1">
                                    <h6 class="fw-bold mb-0 text-truncate">
                                        <a href="${job.detail_url}" target="_blank" class="text-decoration-none text-dark hover-text-danger">
                                            ${escapeHtml(job.title)}
                                        </a>
                                    </h6>
                                    <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1 fw-bold flex-shrink-0" style="font-size: 11px;">
                                        ⭐ ${job.match_score}% Khớp
                                    </span>
                                </div>
                                <p class="text-muted mb-2 text-truncate" style="font-size: 13px;">
                                    <i class="fa-solid fa-building me-1 text-secondary"></i>${escapeHtml(job.company_name)}
                                </p>
                                <div class="d-flex flex-wrap gap-1.5 mb-2.5">
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-2 py-1" style="font-size: 11px;">
                                        <i class="fa-solid fa-money-bill-wave me-1"></i>${escapeHtml(job.salary)}
                                    </span>
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill px-2 py-1" style="font-size: 11px;">
                                        <i class="fa-solid fa-location-dot me-1"></i>${escapeHtml(job.address)}
                                    </span>
                                    <span class="badge bg-info-subtle text-info rounded-pill px-2 py-1" style="font-size: 11px;">
                                        <i class="fa-solid fa-clock me-1"></i>${escapeHtml(job.job_type)}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                    <small class="text-muted" style="font-size: 11.5px;">
                                        <i class="fa-regular fa-calendar-check me-1"></i>Hạn: ${escapeHtml(job.close_date)}
                                    </small>
                                    <div class="d-flex gap-1.5">
                                        <a href="${job.detail_url}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-2.5 py-1" style="font-size: 12px;">
                                            Chi tiết
                                        </a>
                                        <a href="${job.detail_url}" target="_blank" class="btn btn-sm btn-danger rounded-pill px-3 py-1 fw-bold shadow-xs" style="font-size: 12px;">
                                            Ứng tuyển ngay
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            matchedJobsList.innerHTML = html;
        }

        // Render alternative suggestions
        if (alternativeJobs && alternativeJobs.length > 0) {
            altJobsPanel.classList.remove('d-none');
            let altHtml = '';
            alternativeJobs.forEach(job => {
                altHtml += `
                    <div class="p-2.5 rounded-3 border bg-light d-flex justify-content-between align-items-center gap-2">
                        <div class="min-w-0">
                            <h6 class="fw-semibold mb-0 text-truncate" style="font-size: 13.5px;">
                                <a href="${job.detail_url}" target="_blank" class="text-decoration-none text-dark">
                                    ${escapeHtml(job.title)}
                                </a>
                            </h6>
                            <small class="text-muted text-truncate d-block" style="font-size: 11.5px;">
                                ${escapeHtml(job.company_name)} • ${escapeHtml(job.address)} • <strong class="text-success">${escapeHtml(job.salary)}</strong>
                            </small>
                        </div>
                        <a href="${job.detail_url}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-2.5 py-1 flex-shrink-0" style="font-size: 11.5px;">
                            Xem
                        </a>
                    </div>
                `;
            });
            altJobsList.innerHTML = altHtml;
        }
    }

    async function sendMessage(textToSend) {
        const text = (textToSend || userInput.value).trim();
        if (!text) return;

        if (!textToSend) {
            userInput.value = '';
        }

        // Render user message in UI
        renderMessage('user', text);

        // Add to history
        conversationHistory.push({
            role: 'user',
            parts: [{ text: text }]
        });

        // Show typing indicator
        typingIndicator.classList.remove('d-none');
        userInput.disabled = true;
        sendBtn.disabled = true;
        scrollToBottom();

        try {
            const response = await fetch("{{ route('ai.assistant.chat') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    messages: conversationHistory
                })
            });

            const data = await response.json();

            if (data.success) {
                // Update criteria tracker
                if (data.position) criteriaState.position = data.position;
                if (data.salary) criteriaState.salary = data.salary;
                if (data.location) criteriaState.location = data.location;
                if (data.job_type) criteriaState.job_type = data.job_type;
                updateTrackerUI();

                // Append AI reply
                renderMessage('ai', data.ai_message, data.quick_replies || []);

                conversationHistory.push({
                    role: 'model',
                    parts: [{ text: data.ai_message }]
                });

                // If jobs matched, render jobs
                if (data.matched_jobs && data.matched_jobs.length > 0) {
                    renderJobList(data.matched_jobs, data.alternative_jobs || []);
                }
            } else {
                renderMessage('ai', 'Dạ rất tiếc, đã có sự cố kết nối tới hệ thống AI. Bạn vui lòng thử lại nhé!');
            }
        } catch (error) {
            console.error('Chat error:', error);
            renderMessage('ai', 'Không thể kết nối đến máy chủ. Vui lòng kiểm tra lại mạng!');
        } finally {
            typingIndicator.classList.add('d-none');
            userInput.disabled = false;
            sendBtn.disabled = false;
            userInput.focus();
            scrollToBottom();
        }
    }

    // Submit handler
    chatForm.addEventListener("submit", function(e) {
        e.preventDefault();
        sendMessage();
    });

    userInput.addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            sendMessage();
        }
    });

    resetChatBtn.addEventListener("click", function() {
        initChat();
    });

    // Start initial chat
    initChat();
});
</script>
@endsection
