import React, { useRef, useEffect } from "react";
import Typed from "typed.js";

const Hero = () => {
	const el = useRef(null);
	useEffect(() => {
		const typed = new Typed(el.current, {
			strings: ['Fullstack Developer', 'Backend Developer'],
			startDelay: 200,
			typeSpeed: 50,
			backSpeed: 50,
			backDelay: 50,
			loop: true
		});
		return () => {
			typed.destroy();
		}
	}, []);
	return (
		<section
			id="hero"
			className="d-flex flex-column justify-content-center align-items-center"
		>
			<div className="hero-container" data-aos="fade-in">
				<h1>Muhammad Rizky Firdaus</h1>
				<p>
					I'm{" "}
					<span
						className="typed"
						ref={el}
					></span>
				</p>
			</div>
		</section>
	);
};

export default Hero;
