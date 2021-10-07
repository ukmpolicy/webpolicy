
class Library {
    libraryLayoutSelector = '#libraryLayout';
    fileBrowseSelector = '#libraryLayout .file_browse';
    uploadViewSelector = '#libraryLayout .source_view';
    inputFormSelector = null;
    params = [];
    rules = '';
    errors = [];

    constructor() {
        
        this.onUpload();
        
    }

    onUpload() {
        this.getFileBrowse().onchange = (e) => {
            // console.log(this.rules)
            
            let file = this.getFileBrowse().files[0];

            // Change View Source
            document.querySelector(this.uploadViewSelector).style.backgroundImage = `url('${URL.createObjectURL(file)}')`;

            // Create FormData
            let fd = new FormData();
            fd.append('file_source', file);
            fd.append('rules', this.rules);
            if (user_id != '') {
                fd.append('user_id', user_id);
            }

            // Upload File
            axios.post('/api/source/upload', fd, {
                onUploadProgress: (progressEvent) => {
                    let el = document.querySelector('#buttonExplore .loading')
                    el.style.display = 'flex';
                }
            })
            .then(r => {
                console.log(r)
                let el = document.querySelector('#buttonExplore .loading')
                el.style.display = 'none';
                this.choiceSource(r.data.body.id);
            })
            .catch(e => {
                console.dir(e);
                // Swal.fire(
                //     'FAILED',
                //     e.response.data.body.file_source,
                //     'error'
                //   )
                // Show success message
                if (e.response.data.message == 'invalid field') {
                    this.close()
                    let el = document.querySelector('#buttonExplore .loading')
                    el.style.display = 'none';
                    document.querySelector(this.uploadViewSelector).style.backgroundImage = ``;
                    Swal.fire(
                        'Failed',
                        e.response.data.body.file_source[0],
                        'error'
                    )
                }
                // if (e.response.response.data.message == 'invalid field') {
                // }
            });
        }
    }

    choiceSource(id) {
        this.getInputForm().value = id;
        axios.get('/api/source/'+id).then(r => {
            this.onChoiced(r.data.body, this.params);
            document.querySelector(this.uploadViewSelector).style.backgroundImage = ``;
        })
    }

    getInputForm() {
        return document.querySelector(this.inputFormSelector);
    }

    getFileBrowse() {
        return document.querySelector(this.fileBrowseSelector);
    }
    getElement() {
        return document.querySelector(this.libraryLayoutSelector);
    }

    open(inputFormSelector, params, rules = []) {
        this.getElement().classList.add('show');
        this.inputFormSelector = inputFormSelector;
        this.params = params;
        this.rules = rules;
    }

    close() {
        this.getElement().classList.remove('show');
    }

    deleteSource(id, desc) {
        event.preventDefault();
        let conf = confirm('Apakah anda yakin ingin menghapus file '+desc);
        if (conf) {
          document.querySelector('#'+id).submit();
        }
    }

    browse() {
        this.getFileBrowse().click();
    }

    onChoiced() {}
}
