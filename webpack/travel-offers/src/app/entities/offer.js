export default class Offer {

    _id;
    _name;
    _description;
    _dateBegin;
    _dateEnd;
    _imageName;

    static instances = 1;

    constructor(name, description, imageName, id = null, dateBegin = null, dateEnd = null) {
        const d = new Date();

        this._id = id || Offer.instances;
        this._dateBegin = new Date(dateBegin) || d;
        this._dateEnd = new Date(dateEnd) || new Date(d.setDate(d.getDate() + 7));
        this._imageName = imageName;
        this._name = name;
        this._description = description;

        Offer.instances++;
    }

    get id() {
        return this._id;
    }

    set id(value) {
        this._id = value;
    }

    get name() {
        return this._name;
    }

    set name(value) {
        this._name = value;
    }

    get description() {
        return this._description;
    }

    set description(value) {
        this._description = value;
    }

    get dateBegin() {
        return this._dateBegin;
    }

    set dateBegin(value) {
        this._dateBegin = value;
    }

    get dateEnd() {
        return this._dateEnd;
    }

    set dateEnd(value) {
        this._dateEnd = value;
    }

    get imageName() {
        return this._imageName;
    }

    set imageName(value) {
        this._imageName = value;
    }

    dateBeginFormatted() {
        return this._formatDate(this._dateBegin);
    }

    dateEndFormatted() {
        return this._formatDate(this._dateEnd);
    }

    _formatDate(dateToFormat) {
        return dateToFormat.toLocaleDateString('fr-FR');
    }

    static fromJSON(data) {
        return new Offer(
            data._name,
            data._description,
            data._imageName,
            data._id,
            data._dateBegin,
            data._dateEnd
        );
    }
}