import React from "react";

const Header = ({onClickMenu}) => (
	<header id="header">
		<div className="d-flex flex-column">
			<div className="profile">
				<img
					src={process.env.PUBLIC_URL + '/assets/img/Foto.png'}
					alt=""
					className="img-fluid rounded-circle"
				/>
				
				<h1 className="text-light text-center">
					<a href="index.html">Muhammad Rizky Firdaus</a>
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
						<a onClick={onClickMenu} href="#hero" className="nav-link scrollto">
							<i className="bx bx-home"></i> <span>Home</span>
						</a>
					</li>
					<li>
						<a onClick={onClickMenu} href="#about" className="nav-link scrollto">
							<i className="bx bx-user"></i> <span>About</span>
						</a>
					</li>
					<li>
						<a onClick={onClickMenu} href="#resume" className="nav-link scrollto">
							<i className="bx bx-file-blank"></i>{" "}
							<span>Resume</span>
						</a>
					</li>
					<li>
						<a onClick={onClickMenu} href="#portfolio" className="nav-link scrollto">
							<i className="bx bx-book-content"></i>{" "}
							<span>Portfolio</span>
						</a>
					</li>
					<li>
						<a onClick={onClickMenu} href="#contact" className="nav-link scrollto">
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
