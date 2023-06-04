<template>
    <div class="card bg-light shadow-sm">
        <div class="card-body flex wrap flex-md-nowrap">
            <div class="">
                <img
                    :src="item.avatar"
                    alt="avatar"
                    class="img-fluid"
                    width="155"
                />
            </div>

            <div class="ms-3 w-100">
                <div class="row">
                    <div class="column q-pl-md">
                        <h4 class="mb-2 mt-0">
                            {{ item.name }}
                        </h4>
                        <div class="mb-2">
                            <strong>Student Type:</strong>
                            {{ item.student_type.label }}
                        </div>
                        <div class="mb-2">
                            <strong>Joined:</strong>
                            {{ item.created_at_fmt }}
                        </div>
                    </div>
                    <div class="col-grow">
                        <strong> Email </strong>
                        <ul class="list-unstyled mb-2">
                            <li>
                                <a
                                    :href="`mailto:${item.email}`"
                                    class="ms-1"
                                    v-text="item.email"
                                />
                            </li>
                        </ul>
                        <DisplayPhone
                            v-if="item.phones"
                            :phones="item.phones"
                            label="Phone"
                        />
                        <DisplayAddress
                            v-if="item.address"
                            :address="item.address"
                            label="Address"
                        />
                    </div>
                    <div class="col-grow">
                        <div class="mb-2">
                            <strong>School</strong>
                            {{ item.school?.name ?? 'n/a' }}
                        </div>
                        <DisplayAddress
                            v-if="item.school?.address"
                            :address="item.school?.address"
                        />
                    </div>
                    <div class="col-grow">
                        <div
                            class="button flex flex-column align-items-center wrap"
                            style="gap: 3px"
                        >
                            <AppLink
                                :href="`/students/${item.id}/appointments`"
                                class="btn btn-outline-primary btn-block w-100"
                            >
                                Appointments
                            </AppLink>
                            <AppLink
                                :href="`/students/${item.id}/payments`"
                                class="btn btn-outline-primary btn-block w-100"
                            >
                                Payments
                            </AppLink>
                            <AppLink
                                :href="`/students/${item.id}`"
                                class="btn btn-primary btn-block w-100"
                            >
                                View
                            </AppLink>
                            <AppLink
                                :href="`/students/${item.id}/edit`"
                                class="btn btn-primary btn-block w-100"
                            >
                                Edit
                            </AppLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { AppLink, DisplayAddress, DisplayPhone } from '@/Components';

interface Props {
    item: App.Models.Student;
}

defineProps<Props>();
</script>
<style lang="scss" scoped>
.card {
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    -ms-transition: all 0.5s ease;
    transition: all 0.5s ease;

    &:hover {
        filter: brightness(95%);
    }
}

.stats {
    background: #f2f5f8 !important;

    color: #000 !important;
}

.articles {
    font-size: 10px;
    color: #a1aab9;
}

.number1 {
    font-weight: 500;
}

.followers {
    font-size: 10px;
    color: #a1aab9;
}

.number2 {
    font-weight: 500;
}

.rating {
    font-size: 10px;
    color: #a1aab9;
}

.number3 {
    font-weight: 500;
}
</style>
