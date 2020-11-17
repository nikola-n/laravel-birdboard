class BirdboardForm {
    constructor(data) {
        // this.originalData = data;
        this.originalData = JSON.parse(JSON.stringify(data));

        Object.assign(this, data);

        this.errors = {};

        this.submitted = false;
    }

    data() {
        // {'title' : // }
        return Object.keys(this.originalData).reduce((data, attribute) => {
            data[attribute] = this[attribute];

            return data;

        }, {});
        // let data = {};
        //
        // for (let attribute in this.originalData) {
        //     data[attribute] = this[attribute];
        // }
        // return data;
    }


    patch(endpoint) {
        this.submit(endpoint, 'patch');
    }

    delete(endpoint) {
        this.submit(endpoint, 'delete');
    }

    submit(endpoint, requestType = 'post') {
        return axios[requestType](endpoint, this.data())
            .catch(this.onFail.bind(this))
            .then(this.onSuccess.bind(this));
    }

    onFail() {
        this.errors    = error.response.data.errors;
        this.submitted = false;

        throw error;
    }

    onSuccess(response) {
        this.submitted = true;
        this.errors    = {};

        return response;
    }

    reset() {
        Object.assign(this, this.originalData);
    }
}

export default BirdboardForm;
