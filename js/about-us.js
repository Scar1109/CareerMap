// about-us.js

document.addEventListener('DOMContentLoaded', function() {
    // Animate impact numbers
    animateImpactNumbers();

    // Add hover effect to team members
    addTeamMemberHoverEffect();

    // Smooth scroll for navigation
    setupSmoothScroll();

    // Toggle visibility of team member bios
    setupTeamBioToggles();
});

function animateImpactNumbers() {
    const impactItems = document.querySelectorAll('#impact-list li');
    impactItems.forEach(item => {
        const number = parseInt(item.getAttribute('data-value'));
        let current = 0;
        const increment = number / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= number) {
                clearInterval(timer);
                current = number;
            }
            item.querySelector('span').textContent = Math.round(current).toLocaleString();
        }, 10);
    });
}

function addTeamMemberHoverEffect() {
    const teamMembers = document.querySelectorAll('.team-member');
    teamMembers.forEach(member => {
        member.addEventListener('mouseover', () => {
            member.style.transform = 'scale(1.05)';
            member.style.transition = 'transform 0.3s ease';
        });
        member.addEventListener('mouseout', () => {
            member.style.transform = 'scale(1)';
        });
    });
}

function setupSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
}

function setupTeamBioToggles() {
    const teamMembers = document.querySelectorAll('.team-member');
    teamMembers.forEach(member => {
        const bio = member.querySelector('.team-member-bio');
        const toggle = member.querySelector('.bio-toggle');
        if (bio && toggle) {
            toggle.addEventListener('click', () => {
                bio.style.display = bio.style.display === 'none' ? 'block' : 'none';
                toggle.textContent = bio.style.display === 'none' ? 'Read Bio' : 'Hide Bio';
            });
        }
    });
}