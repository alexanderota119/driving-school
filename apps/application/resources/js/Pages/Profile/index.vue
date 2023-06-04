<template>
    <div class="page-holder bg-gray-100">
        <div class="px-lg-4 px-xl-5 contentDiv">
            <!-- Page Header-->
            <div class="page-header mb-4">
                <h1 class="page-heading">Profile</h1>
            </div>
            <section>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-profile mb-4">
                            <div
                                class="card-header"
                                style="
                                    background-image: url(https://therichpost.com/wp-content/uploads/2021/05/bootstrap5-carousel-slider-img1.jpg);
                                "
                            ></div>
                            <div class="card-body text-center">
                                <img
                                    :alt="user.name"
                                    :src="user.avatar"
                                    class="card-profile-img"
                                />
                                <h3 class="q-mb-md">{{ user.name }}</h3>
                                <p class="mb-4">Profile</p>
                                <ed-button
                                    class="d-none btn btn-outline-dark btn-sm"
                                >
                                    <span class="fab fa-twitter"></span> Follow
                                </ed-button>
                            </div>
                        </div>
                        <form class="card mb-4 d-none">
                            <div class="card-header">
                                <h4 class="card-heading">My Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row q-mb-md">
                                    <div
                                        class="col-auto flex align-items-center"
                                    >
                                        <img
                                            alt="Avatar"
                                            class="avatar avatar-lg q-pa-sm"
                                            src="https://therichpost.com/wp-content/uploads/2021/03/avatar2.png"
                                        />
                                    </div>
                                    <div class="col-grow">
                                        <label class="form-label">Name</label>
                                        <input
                                            class="form-control"
                                            placeholder="Your name"
                                        />
                                    </div>
                                </div>
                                <div class="q-mb-md">
                                    <label class="form-label">Bio</label>
                                    <textarea class="form-control" rows="8">
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    </textarea>
                                </div>
                                <div class="q-mb-md">
                                    <label class="form-label">Email</label>
                                    <input
                                        class="form-control"
                                        placeholder="you@domain.com"
                                    />
                                </div>
                                <label class="form-label">Password</label>
                                <input
                                    class="form-control"
                                    type="password"
                                    value="password"
                                />
                            </div>
                            <div class="card-footer text-end">
                                <ed-button class="btn btn-primary"
                                    >Save
                                </ed-button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8">
                        <ctx-form
                            :form="user"
                            action="/profile"
                            class="card mb-4"
                            method="put"
                        >
                            <div class="card-header">
                                <h4 class="card-heading">Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ctx-input
                                            label="First Name"
                                            name="first_name"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <ctx-input
                                            label="Last Name"
                                            name="last_name"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <ctx-input label="Email" name="email" />
                                    </div>
                                    <div class="col-md-6">
                                        <ctx-phone label="Phone" name="phone" />
                                    </div>
                                </div>
                                <div class="row">
                                    <ctx-address col-span="col-md-6" />
                                </div>
                                <div clas="row">
                                    <div class="col-md-12">
                                        <div class="mb-0">
                                            <CtxDropdown
                                                v-if="cars && user.car"
                                                :options="carDropdown"
                                                label="Car"
                                                name="car_id"
                                            />

                                            <CtxDropdown
                                                :options="schoolDropdown"
                                                label="Assigned School"
                                                name="school_id"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <ed-button
                                    class="btn btn-primary"
                                    type="submit"
                                >
                                    Update Profile
                                </ed-button>
                            </div>
                        </ctx-form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { CtxDropdown, CtxForm } from '@/Components';

import { computed } from 'vue';

const { user, cars, schools } = defineProps<{
    user: App.Models.User | App.Models.Instructor | App.Models.Student;
    user_type: 'instructor' | 'student' | 'user';
    cars?: App.Models.Car[];
    schools?: App.Models.School[];
}>();

const carDropdown = computed(() => {
    if (!cars) {
        return [];
    }

    return cars.map(car => {
        return {
            text: car.name,
            value: car.id,
        };
    });
});

const schoolDropdown = computed(() => {
    if (!schools) {
        return [];
    }

    return schools.map(school => {
        return {
            text: school.name,
            value: school.id,
        };
    });
});
</script>
<style lang="scss" scoped>
//.card-header:first-child {
//    border-radius: calc(1rem - 1px) calc(1rem - 1px) 0 0;
//}

.card-header {
    position: relative;
    padding: 2rem 2rem;
    border-bottom: none;
    background-color: white;
    box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
    z-index: 2;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: none;
    box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);
}

.bg-gray-100 {
    background-color: #f8f9fa !important;
}

body {
    font-family: 'Poppins' !important;
}

.text-primary {
    color: #4650dd !important;
}

h1,
.h1,
h2,
.h2,
h3,
.h3,
h4,
.h4,
h5,
.h5,
h6,
.h6 {
    line-height: 1.2;
}

.text-muted {
    color: #6c757d !important;
}

.lead {
    font-size: 1.125rem;
    font-weight: 300;
}

.text-sm {
    font-size: 0.7875rem !important;
}

h3,
.h3 {
    font-size: 1.575rem;
}

.page-holder {
    display: flex;
    overflow-x: hidden;
    width: 100%;
    min-height: calc(100vh - 72px);

    wrap: wrap;
}

a {
    color: #4650dd !important;
    text-decoration: underline !important;
    cursor: pointer;
}

.card-profile-img {
    position: relative;
    max-width: 8rem;
    margin-top: -6rem;
    margin-bottom: 1rem;
    border: 3px solid #fff;
    border-radius: 100%;
    box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);
    z-index: 2;
}

img,
svg {
    vertical-align: middle;
}

.avatar.avatar-lg {
    width: 5rem;
    height: 5rem;
    line-height: 5rem;
}

.avatar {
    display: inline-block;
    position: relative;
    width: 3rem;
    height: 3rem;
    text-align: center;
    border: #dee2e6;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);
    line-height: 3rem;
}

.form-control {
    color: #343a40;
}

.page-heading {
    text-transform: uppercase;
    letter-spacing: 0.2em;
    font-weight: 300;
}

.card-profile .card-header {
    height: 9rem;
    background-position: center center;
    background-size: cover;
}
</style>
