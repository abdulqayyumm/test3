<template>
      <form @submit.prevent="onSubmit">
        <div class="form-group">
          <label>Title:</label>
          <div class="position-relative">
            <select
              v-model.trim.lazy="$v.title.$model"
              class="form-control"
              :class="{ 'is-invalid': $v.title.$error }"
            >
							<option value="">Please Select</option>
              <option value="mr">Mr</option>
              <option value="mrs">Mrs</option>
							<option value="miss">Miss</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>First Name:</label>
          <div class="position-relative">
            <input
              v-model.trim.lazy="$v.firstName.$model"
              type="text"
              required
              class="form-control w-100"
              placeholder="Enter first name"
              :class="{ 'is-invalid': $v.firstName.$error }"
            >
          </div>
        </div>
        <div class="form-group">
          <label>Last Name:</label>
          <div class="position-relative">
            <input
              v-model.trim.lazy="$v.lastName.$model"
              type="text"
              required
              class="form-control w-100"
              placeholder="Enter last name"
              :class="{ 'is-invalid': $v.lastName.$error }"
            >
          </div>
        </div>
        <div class="form-group">
          <label>Email:</label>
          <div class="position-relative">
            <input
              v-model.trim.lazy="$v.email.$model"
              type="email"
              required
              class="form-control w-100"
              placeholder="Enter email"
              :class="{ 'is-invalid': $v.email.$error }"
            >
          </div>
        </div>
        <div class="form-group">
          <label>Phone Number:</label>
          <div class="position-relative">
            <input
              v-model.trim.lazy="$v.phoneNumber.$model"
              required
              type="text"
              class="form-control"
              :class="{ 'is-invalid': $v.phoneNumber.$error }"
            >
          </div>
        </div>

        <div class="form-group">
          <label>Gender:</label>
          <div class="position-relative">
            <input
              v-model.trim.lazy="$v.gender.$model"
              required
              type="text"
              class="form-control"
              :class="{ 'is-invalid': $v.gender.$error }"
            >
          </div>
        </div>

        <div class="form-group">
          <label>Street:</label>
          <div class="position-relative">
            <input
              v-model.trim.lazy="$v.street.$model"
              required
              type="text"
              class="form-control"
              :class="{ 'is-invalid': $v.street.$error }"
            >
          </div>
        </div>

        <div class="form-group">
          <label>City:</label>
          <div class="position-relative">
            <input
              v-model.trim.lazy="$v.city.$model"
              required
              type="text"
              class="form-control"
              :class="{ 'is-invalid': $v.city.$error }"
            >
          </div>
        </div>

        <div class="form-group">
          <label>State:</label>
          <div class="position-relative">
            <input
              v-model.trim.lazy="$v.state.$model"
              required
              type="text"
              class="form-control"
              :class="{ 'is-invalid': $v.state.$error }"
            >
          </div>
        </div>

        <div class="form-group">
          <label>Country:</label>
          <div class="position-relative">
            <input
              v-model.trim.lazy="$v.country.$model"
              required
              type="text"
              class="form-control"
              :class="{ 'is-invalid': $v.country.$error }"
            >
          </div>
        </div>

        <div class="form-group">
          <label>Postcode:</label>
          <div class="position-relative">
            <input
              v-model.trim.lazy="$v.postcode.$model"
              required
              type="text"
              class="form-control"
              :class="{ 'is-invalid': $v.postcode.$error }"
            >
          </div>
        </div>

				<div class="text-center">
					<button
						class="btn blue-btn btn-primary"
						type="submit"
					>
						Update
					</button>
				</div>
      </form>
</template>

<script>

import { validationMixin } from 'vuelidate'
import { required } from 'vuelidate/lib/validators'

export default {
  name: "UserEdit",
	mixins: [validationMixin],

  props: {
    user: {
      type: Object,
      default: () => {}
    }
  },

	validations: {
    title: { required },
		firstName: { required },
		lastName: { required },
		email: { required },
		phoneNumber: { required },
		gender: { required },
		image: { required },
		street: { required },
		city: { required },
		state: { required },
		country: { required },
		postcode: { required }
},

  data () {
    return {
      title: '',
      firstName: '',
      lastName: '',
      email: '',
      phoneNumber: '',
      gender: '',
      image: '',
      street: '',
      city: '',
      state: '',
      country: '',
      postcode: ''
    };
  },

  mounted () {
		this.mapData();
  },

  methods: {
    mapData () {
			this.title = this.user.title;
			this.firstName = this.user.first_name;
			this.lastName = this.user.last_name;
			this.email = this.user.email;
			this.phoneNumber = this.user.phone_number;
			this.gender = this.user.gender;
			this.image = this.user.image;
			this.street = this.user.street;
			this.city = this.user.city;
			this.state = this.user.state;
			this.country = this.user.country;
			this.postcode = this.user.postcode;
    },

		onSubmit () {
			this.$v.$touch();
      if (this.$v.$invalid) return;
			
			const formData = {
				title: this.title,
				first_name: this.firstName,
				last_name: this.lastName,
				email: this.email,
				phone_number: this.phoneNumber,
				gender: this.gender,
				image: this.image,
				street: this.street,
				city: this.city,
				state: this.state,
				country: this.country,
				postcode: this.postcode
			} 
      this.$emit("on-save", formData);
    },
  }
};
</script>

<style scoped></style>
