$.get('/ajax/schedule', {
    'date': new Date()
}).then((data) => {
    data.records.forEach(function (record, i) {
        let {schedule: {dateFrom, dateTo}, records} = data;
        dateFrom = new Date(dateFrom);
        dateTo = new Date(dateTo);
        let total = dateTo - dateFrom+3600000;
        let tpl = `
            <div>
                ${ records.map(({user, timeStart, timeEnd}) => {
                timeStart = new Date(timeStart);
                timeEnd = new Date(timeEnd);
                let start = timeStart - dateFrom;
                let offset = Math.ceil((start * 100 / total)*100)/100;
                start = timeEnd - timeStart;
                let width = Math.ceil((start * 100 / total)*100)/100;
    
                return `
                    <div class="schedule-user" style="margin-left: ${offset}%; width: ${width}%">
                        <img class="schedule-user__avatar" src="${user.avatar}" /> 
                        <div class="schedule-user__name">${user.firstName} ${user.lastName}</div>
                    </div>
                `;
                })}
            </div>
        `;

        $('.schedule-table-row').html(tpl);
    });
});
$(function(){
    $('.schedule_add').on('click',function () {
        showWindow('schedule');
    });
});
