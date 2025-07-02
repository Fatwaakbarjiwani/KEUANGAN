if (typeof window !== "undefined") {
    const token = localStorage.getItem("token");
    const isLoginPage = window.location.pathname === "/login";
    if (!token && !isLoginPage) {
        window.location.href = "/login";
    } else if (token && isLoginPage) {
        window.location.href = "/";
    }
}
