import React from "react";
import ReactDOM from "react-dom";
import renderHTML from "react-render-html";

function __n(interval, singular, plural) {
    return (interval === 1) ? singular : plural;
}

function humanizeInterval(weddingDate, today) {
    let interval;
    today = today || new Date();

    if(weddingDate > today) {
        interval = weddingDate - today;
    } else {
        interval = today - weddingDate;
    }
    // Set the unit values in milliseconds.
    let msecPerMinute = 1000 * 60;
    let msecPerHour = msecPerMinute * 60;
    let msecPerDay = msecPerHour * 24;

    // Calculate how many days the interval contains. Subtract that
    // many days from the interval to determine the remainder.
    let days = Math.floor(interval / msecPerDay );
    interval = interval - (days * msecPerDay );

    // Calculate the hours, minutes, and seconds.
    let hours = Math.floor(interval / msecPerHour );
    interval = interval - (hours * msecPerHour );

    let minutes = Math.floor(interval / msecPerMinute );
    interval = interval - (minutes * msecPerMinute );

    var seconds = Math.floor(interval / 1000 );

    return `${days} <em>${__n(days, "day", "days")}</em>, ${hours} <em>${__n(hours, "hour", "hours")}</em>, ${minutes} <em>${__n(minutes, "minute","minutes")
}</em> and ${seconds} <em>${__n(seconds, "second", "seconds")}</em>`;
}

class Timer extends React.Component {
    constructor(props) {
        super(props);

        this.oldLabel = "To be married in ",
        this.newLabel = "Married since ",
        this.weddingDate = new Date(2018, 4, 27, 10, 0, 0, 0);
        this.state = {
            countDown: humanizeInterval(this.weddingDate),
            label: this.weddingDate > this.props.today ? this.oldLabel : this.newLabel
        };
    }

    componentDidMount() {
        this.timerID = setInterval(
            () => this.tick(), 1000
        );
    }

    componentWillUnmount() {
        clearInterval(this.timerID);
    }

    tick() {
        let today = this.props.today;
        today.setSeconds(today.getSeconds() + 1);

        this.setState({
            label: this.weddingDate > today ? this.oldLabel : this.newLabel,
            countDown: humanizeInterval(this.weddingDate, today)
        });
    }

    render() {
        return renderHTML(this.state.label + this.state.countDown + '.');
    }
}

class App extends React.Component {
    render() {
        // let now = new Date(2018, 4, 27, 9, 59, 55, 0);
        // now.setSeconds(now.getSeconds() + 1);
        // console.log(now);
        return <Timer today={new Date()} />;
    }
}

ReactDOM.render(
    <App />,
    document.getElementById('app')
);
