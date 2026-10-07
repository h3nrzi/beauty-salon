(() => {
  const button = document.querySelector(".nav-toggle");
  const navigation = document.getElementById("mobile-navigation");
  if (!button || !navigation) return;
  const desktop = window.matchMedia("(min-width: 1024px)");
  const setExpanded = (expanded) => {
    button.setAttribute("aria-expanded", String(expanded));
    navigation.hidden = !expanded;
  };
  setExpanded(false);
  button.hidden = false;
  button.addEventListener("click", () => {
    setExpanded(button.getAttribute("aria-expanded") !== "true");
  });
  document.addEventListener("keydown", (event) => {
    if (
      event.key === "Escape" &&
      button.getAttribute("aria-expanded") === "true"
    ) {
      setExpanded(false);
      button.focus();
    }
  });
  desktop.addEventListener("change", () => {
    const focusWasInNavigation = navigation.contains(document.activeElement);
    setExpanded(false);
    if (focusWasInNavigation) {
      const target = desktop.matches
        ? document.querySelector(".desktop-nav a")
        : button;
      target?.focus();
    }
  });
})();
