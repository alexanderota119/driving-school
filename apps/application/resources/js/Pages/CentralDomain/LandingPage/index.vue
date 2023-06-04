<template>
    <nav id="home" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">Ed Driving</a>
            <ed-button
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
                class="navbar-toggler"
                data-bs-target="#navbarSupportedContent"
                data-bs-toggle="collapse"
                type="button"
            >
                <span class="navbar-toggler-icon"></span>
            </ed-button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a
                            aria-current="page"
                            class="nav-link active"
                            href="#home"
                            >Home</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials"
                            >Testimonials</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact-form">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Services</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <strong class="display-5">Ed Driving</strong>
                        <p class="lead text-white-50 mb-0">
                            Educational Driving
                        </p>
                        <p class="lead text-white-50 mb-4 mt-0">
                            Your one stop software for driving schools.
                        </p>
                        <div
                            class="d-grid gap-3 d-sm-flex justify-content-sm-center"
                        >
                            <a
                                class="btn btn-primary btn-lg px-4 me-sm-3"
                                href="#packages"
                                >Get Started</a
                            >
                            <a
                                class="btn btn-outline-light btn-lg px-4"
                                href="#features"
                                >Learn More</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Features section-->
    <features-section />
    <!-- Pricing section-->
    <section id="packages" class="bg-light py-5 border-bottom">
        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h2 class="fw-bolder">Pay as you grow</h2>
                <p class="lead mb-0">With our no hassle pricing plans</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <!-- Pricing card free-->
                <PricingPanel
                    v-for="plan in plans"
                    :perks="plan.perks"
                    :plan-label="plan.label"
                    :plan-name="plan.name"
                    :price="plan.price"
                />
            </div>
        </div>
    </section>
    <!-- Testimonials section-->
    <section id="testimonials" class="py-5 border-bottom">
        <div class="container px-5 my-5 px-5">
            <div class="text-center mb-5">
                <h2 class="fw-bolder">Customer testimonials</h2>
                <p class="lead mb-0">Our customers love working with us</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <testimonials />
                </div>
            </div>
        </div>
    </section>
    <!-- Contact section-->
    <section class="bg-light py-5">
        <div class="container px-5 my-5 px-5">
            <div class="text-center mb-5">
                <div
                    class="feature bg-primary bg-gradient text-white rounded-3 q-mb-md"
                >
                    <i class="bi bi-envelope"></i>
                </div>
                <h2 class="fw-bolder">Get in touch</h2>
                <p class="lead mb-0">We'd love to hear from you</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <contact-form />
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-5">
            <p class="m-0 text-center text-white">
                Copyright &copy; Ed Driving {{ year }}
            </p>
        </div>
    </footer>
</template>
<script lang="ts" setup>
import moment from 'moment';
import ContactForm from './Contact/Form';
import FeaturesSection from './Features/Section';
import PricingPanel from './Pricing/Panel';
import Testimonials from './Testimonials';

defineProps<{}>();

const getPerks = (numberIncluded: number) => {
    let numberActive = 1;

    return [
        { label: '50 instructors', active: numberActive++ <= numberIncluded }, // 1
        { label: '200 students', active: numberActive++ <= numberIncluded }, // 2
        {
            label: 'Instructor Access',
            active: numberActive++ <= numberIncluded,
        }, // 3
        {
            label: 'Free linked domain',
            active: numberActive++ <= numberIncluded,
        }, // 4
        { label: 'Student Access', active: numberActive++ <= numberIncluded }, // 5
        {
            label: 'Custom linked domain',
            active: numberActive++ <= numberIncluded,
        }, // 6
        { label: 'Monthly Reports', active: numberActive++ <= numberIncluded }, // 7
    ];
};

const plans = [
    {
        label: 'free',
        name: 'free',
        price: '$0',

        perks: getPerks(4),
    },
    {
        label: 'Pro',
        name: 'pro',
        price: '$100',

        perks: getPerks(7),
    },
    {
        label: 'Everything',
        name: 'everything',
        price: 'Call',

        perks: getPerks(400),
    },
];

const year = moment().format('Y');

//
</script>
