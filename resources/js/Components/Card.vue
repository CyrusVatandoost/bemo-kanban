<template>
    <div class="card">
        <div @click="toggleModal" class="card-clickable">
            <span> {{ form.title }}</span>
        </div>
        <div v-if="showModal" class="modal">
            <div class="modal-content">
                <form @submit.prevent="submit" class="form">
                    <input
                        class="input"
                        type="text"
                        v-model="form.title"
                        :disabled="form.processing" />
                    <textarea
                        class="input"
                        type="text"
                        v-model="form.description"
                        :disabled="form.processing"></textarea>
                    <div>
                        <button
                            class="button"
                            type="button"
                            @click="toggleModal"
                            :disabled="form.processing">
                            Cancel
                        </button>
                        <button class="button" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue2";

export default {
    props: {
        card: Object,
    },
    data() {
        return {
            showModal: false,
        };
    },
    setup(props) {
        const form = useForm({
            title: props.card.title,
            description: props.card.description,
        });

        return {
            form,
        };
    },
    methods: {
        toggleModal() {
            this.showModal = !this.showModal;
        },
        submit() {
            this.form.put(`/cards/${this.card.id}`, {
                preserveScroll: true,
                onSuccess: () => {
                    this.toggleModal();
                },
            });
        },
    },
};
</script>
