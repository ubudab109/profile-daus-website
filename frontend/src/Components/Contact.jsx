import React from 'react';

const Contact = () => {
	return (
		<section id="contact" className="contact">
			<div className="container">

				<div className="section-title">
					<h2>Contact</h2>
					<p>
						You can contact me for anything and I will reply as soon as possible. You can also contact me via the email address or telephone number listed below.
					</p>
				</div>
				<div className="row" data-aos="fade-in">
					<div className="col-lg-12 d-flex align-items-stretch">
						<div className="info">
							<div className="address">
								<i className="bi bi-geo-alt"></i>
								<h4>Location:</h4>
								<p>Jakarta, Indonesia, South Jakarta 12550</p>
							</div>

							<div className="email">
								<i className="bi bi-envelope"></i>
								<h4>Email:</h4>
								<p>rizkyfirdaus0309@gmail.com</p>
							</div>

							<div className="phone">
								<i className="bi bi-phone"></i>
								<h4>Call:</h4>
								<p>+62 858 8702 8342</p>
							</div>

							<div className="phone">
								<i className="bi bi-whatsapp"></i>
								<h4>Link:</h4>
								<a href="https://wa.me/+6285887028342" target="_blank" rel="noreferrer">
									<p style={{ color: 'blue'}}>Click Here</p>
								</a>
							</div>

						</div>

					</div>
				</div>
			</div>
		</section>
	);
};

export default Contact;
