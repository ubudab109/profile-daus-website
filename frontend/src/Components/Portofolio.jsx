import axios from "axios";
import React, { Fragment, useState } from "react";
import { Modal, Button, Carousel } from "react-bootstrap";

const Portfolio = ({ portfolios }) => {
    const [isOpenPortfolio, setIsOpenPortfolio] = useState(false);
    const [isLoadingFetchingDetail, setIsLoadingFetchingDetail] =
        useState(false);
    const [detailPortfolioData, setDetailPortfolioData] = useState({
        id: "",
        title: "",
        category: "",
        url: "",
        description: "",
        start_date: "",
        end_date: "",
        stack: [],
        images: [],
    });

    const detailPortfolio = async (id) => {
        setIsOpenPortfolio(true);
        setIsLoadingFetchingDetail(true);
        await axios
            .get(`${process.env.REACT_APP_BE_URL}/portfolios/${id}`)
            .then((res) => {
                const data = res.data;
                if (!Array.isArray(data.images)) {
                    data["images"] = Object.values(data.images);
                }
                setDetailPortfolioData(data);
            })
            .catch(() => {
                alert("Error when fetching detail portfolios");
            });
        setIsLoadingFetchingDetail(false);
    };

    const closeModalDetailPortofolio = () => {
        setIsOpenPortfolio(false);
        setDetailPortfolioData({
            id: "",
            title: "",
            category: "",
            url: "",
            description: "",
            start_date: "",
            end_date: "",
            stack: [],
            images: [],
        });
    };

    return (
        <section id="portfolio" className="portfolio section-bg">
            <Modal
                show={isOpenPortfolio}
                onHide={() => closeModalDetailPortofolio()}
                size="xl"
            >
                <Modal.Header closeButton>
                    <Modal.Title>Portfolio</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    {isLoadingFetchingDetail && isOpenPortfolio ? (
                        <div className="row justify-content-center mb-4">
                            <h5>Loading...</h5>
                        </div>
                    ) : (
                        <Fragment>
                            <div className="row justify-content-center mb-4">
                                <div className="col-lg-6 col-md-12 text-center">
                                    <div className="card">
                                        <div className="card-body">
                                            {detailPortfolioData.images ? (
                                                <Carousel data-bs-theme="dark">
                                                    {detailPortfolioData.images.map(
                                                        (image) => (
                                                            <Carousel.Item
                                                                key={image.key}
                                                            >
                                                                <img
                                                                    src={
                                                                        image
                                                                            .initialPreview[0]
                                                                    }
                                                                    alt=""
                                                                    style={{
                                                                        width: "100%",
                                                                    }}
                                                                />
                                                            </Carousel.Item>
                                                        )
                                                    )}
                                                </Carousel>
                                            ) : null}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="row mb-4">
                                <div className="col-12">
                                    <div className="portfolio-info">
                                        <h3>Project information</h3>
                                        <ul className="portfolio-info-ul">
                                            <li className="portfolio-info-li">
                                                <strong>Category</strong>:{" "}
                                                {detailPortfolioData.category}
                                            </li>
                                            <li className="portfolio-info-li">
                                                <strong>
                                                    Client or Company
                                                </strong>
                                                : {detailPortfolioData.company}
                                            </li>
                                            <li className="portfolio-info-li">
                                                <strong>Project date</strong>:{" "}
                                                {detailPortfolioData.start_date}{" "}
                                                -{" "}
                                                {detailPortfolioData.end_date ??
                                                    "Present"}
                                            </li>
                                            <li className="portfolio-info-li">
                                                <strong>Project URL</strong>:{" "}
                                                <a
                                                    href={
                                                        detailPortfolioData.url
                                                    }
                                                    target="_blank"
                                                    rel="noreferrer"
                                                >
                                                    {detailPortfolioData.url}
                                                </a>
                                            </li>
                                            <li className="portfolio-info-li">
                                                <strong>Stack</strong>:{" "}
                                                {detailPortfolioData.stack.map(
                                                    (data, key) => (
                                                        <span
                                                            className="badge bg-secondary"
                                                            style={{
                                                                marginRight:
                                                                    "3px",
                                                            }}
                                                            key={key}
                                                        >
                                                            {data}
                                                        </span>
                                                    )
                                                )}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-12">
                                    <div className="portfolio-info description">
                                        <h2>Description</h2>
                                        <div
                                            dangerouslySetInnerHTML={{
                                                __html: detailPortfolioData.description,
                                            }}
                                        />
                                    </div>
                                </div>
                            </div>
                        </Fragment>
                    )}
                </Modal.Body>
                <Modal.Footer>
                    <Button
                        variant="secondary"
                        onClick={() => closeModalDetailPortofolio()}
                    >
                        Close
                    </Button>
                </Modal.Footer>
            </Modal>
            <div className="container">
                <div className="section-title">
                    <h2>Portfolio</h2>
                    <p>
                        As a developer I have successfully developed several
                        applications, especially websites and have been used by
                        several clients and company. These websites such as:
                    </p>
                </div>
                <div
                    className="row portfolio-container"
                    data-aos="fade-up"
                    data-aos-delay="100"
                >
                    {portfolios.map((data) => (
                        <div
                            className="col-lg-4 col-md-6 portfolio-item filter-app"
                            key={data.id}
                            onClick={() => detailPortfolio(data.id)}
                        >
                            <div className="portfolio-wrap">
                                <img
                                    src={data.first_image}
                                    className="img-fluid-portfolio"
                                    alt=""
                                />
                                <div className="portfolio-links">
                                    <div
                                        data-gallery="portfolioGallery"
                                        className="portfolio-lightbox"
                                        title="App 1"
                                    >
                                        {data.title}
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default Portfolio;
