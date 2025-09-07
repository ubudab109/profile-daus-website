import React from "react";

const Header = () => (
	<header id="header">
		<div className="d-flex flex-column">
			<div className="profile">
				<img
					src={process.env.PUBLIC_URL + '/assets/img/foto.png'}
					alt=""
					className="img-fluid rounded-circle"
				/>
				<h1 className="text-light">
					<a href="index.html">Muhammad Rizky</a>
				</h1>
				<div className="social-links mt-3 text-center">
					<a href="https://github.com/ubudab109/" target="_blank" rel="noreferrer" className="github">
						<i className="bx bxl-github"></i>
					</a>
					<a href="https://www.instagram.com/rizkyfirdaus0309/" target="_blank" rel="noreferrer" className="instagram">
						<i className="bx bxl-instagram"></i>
					</a>
					<a href="https://www.linkedin.com/in/rizkyfirdaus0309/" target="_blank" rel="noreferrer" className="linkedin">
						<i className="bx bxl-linkedin"></i>
					</a>
				</div>
			</div>

			<nav id="navbar" className="nav-menu navbar">
				<ul>
					<li>
						<a href="#hero" className="nav-link scrollto">
							<i className="bx bx-home"></i> <span>Home</span>
						</a>
					</li>
					<li>
						<a href="#about" className="nav-link scrollto">
							<i className="bx bx-user"></i> <span>About</span>
						</a>
					</li>
					<li>
						<a href="#resume" className="nav-link scrollto">
							<i className="bx bx-file-blank"></i>{" "}
							<span>Resume</span>
						</a>
					</li>
					<li>
						<a href="#portfolio" className="nav-link scrollto">
							<i className="bx bx-book-content"></i>{" "}
							<span>Portfolio</span>
						</a>
					</li>
					<li>
						<a href="#contact" className="nav-link scrollto">
							<i className="bx bx-envelope"></i>{" "}
							<span>Contact</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>
);

export default Header;
