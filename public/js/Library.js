
class Library {
    libraryLayoutSelector = '#libraryLayout';
    fileBrowseSelector = '#libraryLayout .file_browse';
    uploadViewSelector = '#libraryLayout .source_view';
    inputFormSelector = null;
    params = [];

    constructor() {
        
        this.onUpload();
        
    }

    onUpload() {
        this.getFileBrowse().onchange = (e) => {
            
            let file = this.getFileBrowse().files[0];

            // Change View Source
            document.querySelector(this.uploadViewSelector).style.backgroundImage = `url('${URL.createObjectURL(file)}')`;

            // Create FormData
            let fd = new FormData();
            fd.append('file_source', file);
            if (user_id != '') {
                fd.append('user_id', user_id);
            }

            // Upload File
            axios.post('/api/source/upload', fd, {
                onUploadProgress: (progressEvent) => {
                  const totalLength = progressEvent.lengthComputable ? progressEvent.total : progressEvent.target.getResponseHeader('content-length') || progressEvent.target.getResponseHeader('x-decompressed-content-length');
                  // console.log("onUploadProgress", totalLength);
                  if (totalLength !== null) {
                    let el = document.querySelector('#buttonExplore .loading');
                    // console.log(el)
                    document.querySelector('#file_source_label').innerHTML = file.name;
                    el.style.display = 'block';
                    el.style.transition = `1s`;
                    el.style.marginLeft = `${Math.round( (progressEvent.loaded * 100) / totalLength )}%`;
                    if (el.style.marginLeft == '100%') {
                      setTimeout(() => {
                        el.style.display = 'none';
                        el.style.marginLeft = `0%`;
                      }, 2000)
                    }
                  }
                }
            })
            .then(r => {
                this.choiceSource(r.data.body.id);
            })
            .catch(e => {
                console.dir(e);
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

    open(inputFormSelector, params) {
        this.getElement().classList.add('show');
        this.inputFormSelector = inputFormSelector;
        this.params = params;
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
