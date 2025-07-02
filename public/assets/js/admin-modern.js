// Admin Panel JavaScript - Modern UI with RTL/LTR Support

// Sidebar Toggle Function - Critical for Mobile Responsiveness
window.toggleSidebar = function () {
    console.log("toggleSidebar function called");

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebarOverlay");
    const menuBtn = document.getElementById("mobileMenuBtn");
    const body = document.body;

    console.log("Sidebar element found:", !!sidebar);
    console.log("Overlay element found:", !!overlay);
    console.log("Menu button found:", !!menuBtn);

    if (!sidebar || !overlay) {
        console.error("Sidebar or overlay element not found!");
        return;
    }

    // Check if RTL direction
    const isRTL =
        document.documentElement.dir === "rtl" ||
        document.documentElement.getAttribute("dir") === "rtl" ||
        document.documentElement.lang === "ar";
    console.log("Is RTL:", isRTL);

    // Fix positioning for RTL/LTR
    if (isRTL) {
        sidebar.style.left = "auto";
        sidebar.style.right = "0";
    } else {
        sidebar.style.left = "0";
        sidebar.style.right = "auto";
    }

    // Clean approach: check if sidebar is currently visible
    const currentTransform = sidebar.style.transform || "";
    const isHidden =
        currentTransform.includes("translateX(-") ||
        currentTransform.includes("translateX(100%)") ||
        (!currentTransform && window.innerWidth < 1024);

    console.log("Sidebar is currently hidden:", isHidden);
    console.log("Current sidebar classes:", sidebar.className);
    console.log("Current sidebar style.transform:", sidebar.style.transform);
    console.log(
        "Current sidebar position - left:",
        sidebar.style.left,
        "right:",
        sidebar.style.right
    );

    // Clear any existing transform classes
    sidebar.classList.remove(
        "-translate-x-full",
        "translate-x-full",
        "translate-x-0",
        "-translate-x-0"
    );

    if (isHidden) {
        console.log("Showing sidebar...");
        // Show sidebar using inline styles for reliability
        sidebar.style.transform = "translateX(-1%)";
        sidebar.style.visibility = "visible";
        sidebar.style.opacity = "1";
        // Force override any conflicting classes
        sidebar.style.setProperty("transform", "translateX(-1%)", "important");

        overlay.classList.remove("hidden");
        body.classList.add("sidebar-open");
        body.style.overflow = "hidden";

        if (menuBtn) {
            menuBtn.innerHTML = '<i class="fas fa-times text-lg"></i>';
            menuBtn.classList.add(
                "bg-primary-100",
                "dark:bg-primary-900/30",
                "text-primary-600",
                "dark:text-primary-400"
            );
        }
        console.log("Sidebar shown. Transform:", sidebar.style.transform);
        console.log("Sidebar visibility:", sidebar.style.visibility);
        console.log(
            "Sidebar computed style:",
            window.getComputedStyle(sidebar).transform
        );
    } else {
        console.log("Hiding sidebar...");
        // Hide sidebar using inline styles
        if (isRTL) {
            sidebar.style.transform = "translateX(100%)";
            sidebar.style.setProperty(
                "transform",
                "translateX(100%)",
                "important"
            );
        } else {
            sidebar.style.transform = "translateX(-100%)";
            sidebar.style.setProperty(
                "transform",
                "translateX(-100%)",
                "important"
            );
        }
        sidebar.style.visibility = "hidden";
        sidebar.style.opacity = "0";

        overlay.classList.add("hidden");
        body.classList.remove("sidebar-open");
        body.style.overflow = "";

        if (menuBtn) {
            menuBtn.innerHTML = '<i class="fas fa-bars text-lg"></i>';
            menuBtn.classList.remove(
                "bg-primary-100",
                "dark:bg-primary-900/30",
                "text-primary-600",
                "dark:text-primary-400"
            );
        }
        console.log("Sidebar hidden. Transform:", sidebar.style.transform);
        console.log(
            "Sidebar computed style:",
            window.getComputedStyle(sidebar).transform
        );
    }
};

// Initialize Sidebar State and Handle Window Resize
(function () {
    function initializeSidebar() {
        console.log("Initializing sidebar...");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");

        if (!sidebar || !overlay) {
            console.log("Sidebar or overlay not found during initialization");
            return;
        }

        // Check if RTL direction
        const isRTL =
            document.documentElement.dir === "rtl" ||
            document.documentElement.getAttribute("dir") === "rtl" ||
            document.documentElement.lang === "ar";
        console.log("Is RTL during init:", isRTL);

        // Set correct positioning for RTL/LTR
        if (isRTL) {
            sidebar.style.left = "auto";
            sidebar.style.right = "0";
        } else {
            sidebar.style.left = "0";
            sidebar.style.right = "auto";
        }

        // Clear any transform classes
        sidebar.classList.remove(
            "-translate-x-full",
            "translate-x-full",
            "translate-x-0",
            "-translate-x-0"
        );

        if (window.innerWidth < 1024) {
            console.log("Mobile view - hiding sidebar");
            // Mobile: hide sidebar with inline styles
            if (isRTL) {
                sidebar.style.transform = "translateX(100%)";
            } else {
                sidebar.style.transform = "translateX(-100%)";
            }
            overlay.classList.add("hidden");
            document.body.style.overflow = "";
            document.body.classList.remove("sidebar-open");
        } else {
            console.log("Desktop view - showing sidebar");
            // Desktop: show sidebar
            sidebar.style.transform = "translateX(0)";
            overlay.classList.add("hidden");
            document.body.style.overflow = "";
            document.body.classList.remove("sidebar-open");
        }
        console.log("Sidebar initialized. Transform:", sidebar.style.transform);
        console.log(
            "Sidebar position - left:",
            sidebar.style.left,
            "right:",
            sidebar.style.right
        );
    }

    // Initialize immediately
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initializeSidebar);
    } else {
        initializeSidebar();
    }

    // Handle window resize
    window.addEventListener("resize", function () {
        const menuBtn = document.getElementById("mobileMenuBtn");
        initializeSidebar();

        // Reset menu button state
        if (menuBtn) {
            menuBtn.innerHTML = '<i class="fas fa-bars text-lg"></i>';
            menuBtn.classList.remove(
                "bg-primary-100",
                "dark:bg-primary-900/30",
                "text-primary-600",
                "dark:text-primary-400"
            );
        }
    });
})();

// Add overlay click handler and sidebar close button handler
document.addEventListener("DOMContentLoaded", function () {
    const overlay = document.getElementById("sidebarOverlay");
    const sidebarCloseBtn = document.getElementById("sidebarCloseBtn");

    // Overlay click handler
    if (overlay) {
        overlay.addEventListener("click", function (e) {
            if (e.target === overlay) {
                console.log("Overlay clicked - closing sidebar");
                window.toggleSidebar();
            }
        });
    }

    // Sidebar close button handler (additional safety)
    if (sidebarCloseBtn) {
        sidebarCloseBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            console.log("Sidebar close button clicked");
            window.toggleSidebar();
        });
    }

    // Add click handler for any close button in sidebar
    document.addEventListener("click", function (e) {
        if (
            e.target.closest("#sidebarCloseBtn") ||
            e.target.id === "sidebarCloseBtn"
        ) {
            e.preventDefault();
            e.stopPropagation();
            console.log("Close button detected - closing sidebar");
            window.toggleSidebar();
        }
    });
});

// Theme Management
function initializeTheme() {
    const savedTheme = localStorage.getItem("theme") || "light";
    const systemPrefersDark = window.matchMedia(
        "(prefers-color-scheme: dark)"
    ).matches;
    const theme =
        savedTheme === "system"
            ? systemPrefersDark
                ? "dark"
                : "light"
            : savedTheme;

    if (theme === "dark") {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
}

function toggleTheme() {
    const isDark = document.documentElement.classList.contains("dark");
    if (isDark) {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("theme", "light");
    } else {
        document.documentElement.classList.add("dark");
        localStorage.setItem("theme", "dark");
    }
}

// Language Management
function toggleLanguage() {
    const currentLang = document.documentElement.getAttribute("lang");
    const newLang = currentLang === "ar" ? "en" : "ar";
    const newDir = newLang === "ar" ? "rtl" : "ltr";

    // Store language preference
    localStorage.setItem("language", newLang);

    // Redirect to current page with new language
    const url = new URL(window.location);
    url.searchParams.set("lang", newLang);
    window.location.href = url.toString();
}

// Loading Overlay Functions
function showLoading() {
    const loadingOverlay = document.getElementById("loadingOverlay");
    if (loadingOverlay) {
        loadingOverlay.classList.remove("hidden");
    }
}

function hideLoading() {
    const loadingOverlay = document.getElementById("loadingOverlay");
    if (loadingOverlay) {
        loadingOverlay.classList.add("hidden");
    }
}

// Enhanced password toggle
function togglePassword(inputId = "password") {
    const passwordInput = document.getElementById(inputId);
    if (!passwordInput) return;

    const eyeIcon = passwordInput.nextElementSibling?.querySelector("i");
    if (!eyeIcon) return;

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}

// Dropdown toggle function - Make it globally accessible
window.toggleDropdown = function (dropdownId) {
    console.log("toggleDropdown called with:", dropdownId);

    const dropdown = document.getElementById(dropdownId);
    if (!dropdown) {
        console.error(`Dropdown element not found: ${dropdownId}`);
        return;
    }

    console.log("Dropdown element found:", dropdown);
    console.log("Current classes:", dropdown.className);

    // Special handling for header dropdowns
    if (dropdownId === "languageMenu" || dropdownId === "userMenu") {
        console.log("Handling header dropdown");

        // Close all other header dropdowns
        const allMenus = ["languageMenu", "userMenu"];
        allMenus.forEach((id) => {
            if (id !== dropdownId) {
                const menu = document.getElementById(id);
                if (menu) {
                    menu.classList.add("hidden");
                    menu.classList.remove("show");
                    console.log("Closed other menu:", id);
                }
            }
        });

        // Toggle the requested dropdown
        const isHidden = dropdown.classList.contains("hidden");
        console.log("Is hidden:", isHidden);

        if (isHidden) {
            dropdown.classList.remove("hidden");
            dropdown.classList.add("show");
            console.log("Showed dropdown:", dropdownId);
        } else {
            dropdown.classList.add("hidden");
            dropdown.classList.remove("show");
            console.log("Hidden dropdown:", dropdownId);
        }

        console.log("Final classes:", dropdown.className);
        return;
    }

    // Standard dropdown handling for other dropdowns
    console.log("Handling standard dropdown");

    document.querySelectorAll(".dropdown-menu").forEach((menu) => {
        if (menu.id !== dropdownId) {
            menu.classList.remove("show");
            menu.classList.add("hidden");
        }
    });

    const isHidden = dropdown.classList.contains("hidden");
    if (isHidden) {
        dropdown.classList.remove("hidden");
        dropdown.classList.add("show");
        console.log("Showed standard dropdown:", dropdownId);
    } else {
        dropdown.classList.add("hidden");
        dropdown.classList.remove("show");
        console.log("Hidden standard dropdown:", dropdownId);
    }

    console.log("Final classes:", dropdown.className);
};

// Navigation group toggle - Make it globally accessible
window.toggleNavGroup = function (groupName) {
    console.log("toggleNavGroup called with:", groupName);

    const menu = document.getElementById(groupName + "-menu");
    const icon = document.getElementById(groupName + "-icon");
    const group = menu?.closest(".nav-group");

    console.log("Menu element found:", !!menu);
    console.log("Icon element found:", !!icon);
    console.log("Group element found:", !!group);

    if (!menu || !icon) {
        console.error(`Navigation group elements not found for: ${groupName}`);
        console.log("Expected menu ID:", groupName + "-menu");
        console.log("Expected icon ID:", groupName + "-icon");
        return;
    }

    console.log("Menu current classes:", menu.className);
    console.log("Icon current classes:", icon.className);

    if (menu.classList.contains("hidden")) {
        // Open the menu
        menu.classList.remove("hidden");
        icon.classList.add("rotate-180");
        group?.classList.add("active");
        console.log("Opened navigation group:", groupName);
    } else {
        // Close the menu
        menu.classList.add("hidden");
        icon.classList.remove("rotate-180");
        group?.classList.remove("active");
        console.log("Closed navigation group:", groupName);
    }

    console.log("Menu final classes:", menu.className);
    console.log("Icon final classes:", icon.className);
};

// Debug function to test dropdown functionality
window.testDropdowns = function () {
    console.log("Testing dropdown functionality...");

    // Test header dropdowns
    const languageDropdown = document.getElementById("languageMenu");
    const userDropdown = document.getElementById("userMenu");

    console.log("Language dropdown found:", !!languageDropdown);
    console.log("User dropdown found:", !!userDropdown);

    // Test navigation groups
    const navGroups = document.querySelectorAll(".nav-group");
    console.log("Navigation groups found:", navGroups.length);

    // Test functions
    console.log("toggleDropdown function:", typeof window.toggleDropdown);
    console.log("toggleNavGroup function:", typeof window.toggleNavGroup);

    return {
        languageDropdown: !!languageDropdown,
        userDropdown: !!userDropdown,
        navGroups: navGroups.length,
        functions: {
            toggleDropdown: typeof window.toggleDropdown,
            toggleNavGroup: typeof window.toggleNavGroup,
        },
    };
};

// Initialize all functionality on DOM content loaded
document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM Content Loaded - Initializing dropdowns...");

    // Initialize theme
    initializeTheme();

    // Test dropdown elements
    const languageMenu = document.getElementById("languageMenu");
    const userMenu = document.getElementById("userMenu");
    console.log("Language menu found:", !!languageMenu);
    console.log("User menu found:", !!userMenu);

    // Ensure functions are globally accessible
    if (typeof window.toggleDropdown !== "function") {
        console.error("toggleDropdown not found on window object");
    } else {
        console.log("toggleDropdown function available");
    }

    if (typeof window.toggleNavGroup !== "function") {
        console.error("toggleNavGroup not found on window object");
    } else {
        console.log("toggleNavGroup function available");
    }

    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        document.querySelectorAll('[role="alert"]').forEach((alert) => {
            alert.style.transition = "opacity 0.5s ease, transform 0.5s ease";
            alert.style.opacity = "0";
            alert.style.transform = "translateY(-20px)";
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.remove();
                }
            }, 500);
        });
    }, 5000);

    // Add click to close functionality for alerts
    document.querySelectorAll('[role="alert"] button').forEach((button) => {
        button.addEventListener("click", function () {
            const alert = this.closest('[role="alert"]');
            if (alert) {
                alert.style.transition = "all 0.3s ease";
                alert.style.opacity = "0";
                alert.style.transform = "translateX(100%)";
                setTimeout(() => alert.remove(), 300);
            }
        });
    });

    // Close dropdowns when clicking outside - Enhanced version
    document.addEventListener("click", function (e) {
        console.log("Document click detected:", e.target);

        // Handle header dropdowns
        const dropdowns = ["languageDropdown", "userDropdown"];

        dropdowns.forEach((dropdownId) => {
            const dropdown = document.getElementById(dropdownId);
            if (dropdown && !dropdown.contains(e.target)) {
                const menuId =
                    dropdownId === "languageDropdown"
                        ? "languageMenu"
                        : "userMenu";
                const menu = document.getElementById(menuId);
                if (menu && !menu.classList.contains("hidden")) {
                    console.log("Closing dropdown:", menuId);
                    menu.classList.add("hidden");
                    menu.classList.remove("show");
                }
            }
        });

        // Handle other dropdowns
        if (!e.target.closest(".dropdown")) {
            document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                if (!menu.classList.contains("hidden")) {
                    console.log("Closing standard dropdown:", menu.id);
                    menu.classList.remove("show");
                    menu.classList.add("hidden");
                }
            });
        }
    });

    // Add escape key handler
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            console.log("Escape key pressed - closing all dropdowns");

            // Close header dropdowns
            ["languageMenu", "userMenu"].forEach((menuId) => {
                const menu = document.getElementById(menuId);
                if (menu) {
                    menu.classList.add("hidden");
                    menu.classList.remove("show");
                }
            });

            // Close other dropdowns
            document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                menu.classList.remove("show");
                menu.classList.add("hidden");
            });
        }
    });

    // Add Escape key handler to close sidebar
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("sidebarOverlay");

            // Check if sidebar is open (overlay is visible)
            if (overlay && !overlay.classList.contains("hidden")) {
                console.log("Escape key pressed - closing sidebar");
                window.toggleSidebar();
            }
        }
    });

    console.log("All dropdown event listeners initialized");
});

// Enhanced form submissions with loading states
document.addEventListener("submit", function (e) {
    if (
        e.target.tagName === "FORM" &&
        !e.target.classList.contains("no-loading")
    ) {
        const submitBtn = e.target.querySelector(
            'button[type="submit"], input[type="submit"]'
        );
        if (submitBtn) {
            const originalText = submitBtn.innerHTML;
            const loadingText = submitBtn.dataset.loading || "جاري المعالجة...";

            submitBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin mr-2 rtl:ml-2 rtl:mr-0"></i>' +
                loadingText;
            submitBtn.disabled = true;

            // Re-enable after 10 seconds as fallback
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 10000);
        }

        showLoading();
    }
});

// Hide loading on page load
window.addEventListener("load", hideLoading);

// Keyboard shortcuts
document.addEventListener("keydown", function (e) {
    // Escape key to close dropdowns
    if (e.key === "Escape") {
        // Close header dropdowns
        document.getElementById("languageMenu")?.classList.add("hidden");
        document.getElementById("userMenu")?.classList.add("hidden");

        // Close other dropdowns
        document.querySelectorAll(".dropdown-menu").forEach((menu) => {
            menu.classList.remove("show");
            menu.classList.add("hidden");
        });

        // Close sidebar on mobile
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");

        if (sidebar && overlay && !overlay.classList.contains("hidden")) {
            window.toggleSidebar();
        }
    }

    // Ctrl/Cmd + D for dark mode toggle
    if ((e.ctrlKey || e.metaKey) && e.key === "d") {
        e.preventDefault();
        toggleTheme();
    }

    // Ctrl/Cmd + L for language toggle
    if ((e.ctrlKey || e.metaKey) && e.key === "l") {
        e.preventDefault();
        toggleLanguage();
    }

    // Escape key to close sidebar on mobile
    if (e.key === "Escape") {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");

        if (sidebar && overlay && !overlay.classList.contains("hidden")) {
            window.toggleSidebar();
        }
    }
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        }
    });
});

// Performance optimization - lazy load images
if ("IntersectionObserver" in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.classList.remove("lazy");
                    observer.unobserve(img);
                }
            }
        });
    });

    document.querySelectorAll("img[data-src]").forEach((img) => {
        imageObserver.observe(img);
    });
}

// Close sidebar when clicking outside
document.addEventListener("click", function (e) {
    const sidebar = document.getElementById("sidebar");
    const toggleButton = document.querySelector('[onclick*="toggleSidebar"]');
    const overlay = document.getElementById("sidebarOverlay");

    if (
        window.innerWidth < 1024 &&
        overlay &&
        !overlay.classList.contains("hidden") &&
        !sidebar?.contains(e.target) &&
        !toggleButton?.contains(e.target)
    ) {
        window.toggleSidebar();
    }
});

// Enhanced alert management with better animations
document.addEventListener("DOMContentLoaded", function () {
    // Auto-hide alerts after 8 seconds with better animation
    setTimeout(() => {
        document.querySelectorAll('[role="alert"]').forEach((alert) => {
            if (alert.parentNode) {
                alert.style.transition =
                    "all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
                alert.style.opacity = "0";
                alert.style.transform = "translateY(-20px) scale(0.95)";
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.remove();
                    }
                }, 500);
            }
        });
    }, 8000);
});

// jQuery and DataTables Configuration
$(document).ready(function () {
    // Enhanced DataTables with dark mode support
    const darkMode = document.documentElement.classList.contains("dark");

    const dataTableConfig = {
        searching: true,
        paging: true,
        pageLength: 10,
        info: true,
        responsive: true,
        language: {
            search: "بحث:",
            lengthMenu: "عرض _MENU_ مدخلات",
            info: "عرض _START_ إلى _END_ من _TOTAL_ مدخلات",
            infoEmpty: "لا توجد مدخلات متاحة",
            infoFiltered: "تم الفلترة من _MAX_ إجمالي المدخلات",
            paginate: {
                first: "الأول",
                last: "الأخير",
                next: "التالي",
                previous: "السابق",
            },
        },
        dom: '<"flex flex-col sm:flex-row justify-between items-center mb-4"<"flex items-center mb-2 sm:mb-0"l><"flex items-center"f>>t<"flex flex-col sm:flex-row justify-between items-center mt-4"<"mb-2 sm:mb-0"i><"flex items-center"p>>',
    };

    // Apply DataTables to common table IDs
    $("#basic-datatables, #multi-filter-select, #add-row").DataTable(
        dataTableConfig
    );

    // Enhanced Select2 with dark mode support
    $("#city_ids").select2({
        placeholder: "المدن",
        allowClear: true,
        tags: true,
        closeOnSelect: false,
        theme: darkMode ? "dark" : "default",
    });

    // Re-initialize Select2 when theme changes
    $(document).on("themeChanged", function () {
        $("#city_ids")
            .select2("destroy")
            .select2({
                placeholder: "المدن",
                allowClear: true,
                tags: true,
                closeOnSelect: false,
                theme: document.documentElement.classList.contains("dark")
                    ? "dark"
                    : "default",
            });
    });
});

// Enhanced SweetAlert for deletions
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-btn").forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const form = this.closest("form");
            const isDark = document.documentElement.classList.contains("dark");

            Swal.fire({
                title: "هل أنت متأكد؟",
                text: "لا يمكن التراجع عن هذا الإجراء",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "نعم، احذف!",
                cancelButtonText: "إلغاء",
                background: isDark ? "#1f2937" : "#ffffff",
                color: isDark ? "#f3f4f6" : "#111827",
                customClass: {
                    popup: "rounded-xl shadow-2xl",
                    confirmButton: "rounded-lg px-6 py-3 font-medium",
                    cancelButton: "rounded-lg px-6 py-3 font-medium",
                },
                showClass: {
                    popup: "animate-fadeIn",
                },
                hideClass: {
                    popup: "animate-fadeOut",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    form.submit();
                }
            });
        });
    });
});

// Theme change event dispatcher
const originalToggleTheme = window.toggleTheme;
window.toggleTheme = function () {
    originalToggleTheme();
    if (typeof $ !== "undefined") {
        $(document).trigger("themeChanged");
    }
};

// Export functions for global access
window.toggleSidebar = toggleSidebar;
window.toggleTheme = toggleTheme;
window.toggleLanguage = toggleLanguage;
window.togglePassword = togglePassword;
window.toggleDropdown = toggleDropdown;
window.toggleNavGroup = toggleNavGroup;
window.showLoading = showLoading;
window.hideLoading = hideLoading;

// Additional utility functions for admin panel
window.confirmDelete = function (message = "هل أنت متأكد من الحذف؟") {
    return confirm(message);
};

window.printPage = function () {
    window.print();
};

window.scrollToTop = function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
};
