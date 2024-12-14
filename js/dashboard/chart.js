x = 0;
y = 0;

let percentage_archives1 = percentage_archives;
let percentage_images1 = percentage_images;
let percentage_documents1 = percentage_documents;
let percentage_backups1 = percentage_backups;
let percentage_text1 = percentage_text;
let percentage_audio1 = percentage_audio;
let percentage_video1 = percentage_video;


const legendList = (chart, id) => {
  const legendContainer = document.getElementById(id);
  let listContainer = legendContainer.querySelector('ul');

  if(!listContainer) {
    listContainer = document.createElement('ul');
    listContainer.className = 'listContainer';
    legendContainer.appendChild(listContainer);
  }
  return listContainer;
}

const doughnut_data = {
    labels: ['Free Space', 'Filled Space'],
    datasets: [{
      label: '',
      data: [100, 0],
      backgroundColor: [
        'rgb(90, 90, 95)',
        'rgb(0, 173, 181)'
      ],
      borderColor: [
        'rgb(90, 90, 95)',
        'rgb(0, 173, 181)'
      ],
      hoverOffset: 0
    }]
  };

  const valuesConvertToPercent = {
    id: 'valuesConvertToPercent',
    beforeDatasetsDraw(chart, args, options) {
      const { ctx, data } = chart;

      let freeSpacePercentage = disk_free_space_bytes / disk_max_space_bytes * 100;
      let filledSpacePercentage = disk_filled_space_bytes / disk_max_space_bytes * 100;

      chart.data.datasets[0].data[0] = freeSpacePercentage.toFixed(1);
      chart.data.datasets[0].data[1] = filledSpacePercentage.toFixed(1);
      chart.update();

    }
  }
  
  const doughnutLabel = {
    id: 'doughnutLabel',
    beforeDatasetsDraw(chart, args, pluginOptions) {
      const { ctx, data } = chart;

      ctx.shadowColor = '#000000';
      ctx.shadowBlur = 20;
      ctx.shadowOffsetX = 0;
      ctx.shadowOffsetY = 0;

      function resetShadow() {
        ctx.shadowColor = 'transparent';
        ctx.shadowBlur = 0;
        ctx.shadowOffsetX = 0;
        ctx.shadowOffsetY = 0;
      }
  
      ctx.save();
      ctx.shadowColor = 'rgb(26, 26, 26)';
        ctx.shadowBlur = 10;
        ctx.shadowOffsetX = 0;
        ctx.shadowOffsetY = 0;
      const xCoor = chart.getDatasetMeta(0).data[0].x;
      const yCoor = chart.getDatasetMeta(0).data[0].y;
      ctx.beginPath();
      ctx.arc(xCoor, yCoor, 80, 0, 2 * Math.PI);
      ctx.fillStyle = 'rgb(57, 62, 70)';
      const circle = ctx.fill();
      resetShadow();
      ctx.font = 'bold 42px "Rajdhani", sans-serif';
      ctx.fillStyle = 'rgb(219, 219, 219)';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      const endValue = chart.data.datasets[0].data[1];
        const startValue = 0.0;

        chart.options.animation = {
            duration: 2000, 
            onProgress: (animation) => {
                
                const easedProgress = easeOutExpo (animation.currentStep / animation.numSteps);
                const currentValue = startValue + easedProgress * (endValue - startValue);

                
                ctx.font = 'bold 42px "Rajdhani", sans-serif';
                ctx.fillStyle = 'rgb(219, 219, 219)';
                ctx.fillText(currentValue.toFixed(1) + "%", xCoor, yCoor - 5);
                resetShadow();
                
            }
        };
      ctx.font = 'bold 16px Varela Round';
      ctx.fillStyle = 'rgb(162, 160, 160)';
      ctx.fillText(`Total: ${disk_max_space}`, xCoor, yCoor + 25);
      resetShadow()
     
    }
  
  }

  function easeOutExpo(t) {
    return t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
  }


   const htmlLegendPlugin = {
    id: 'htmlLegend',
    beforeDatasetsDraw(chart, args, options) {
      const ul = legendList(chart, options.containerID);

      while(ul.firstChild) {
        ul.firstChild.remove();
        var x = 0
      }

      const items = chart.options.plugins.legend.labels.generateLabels(chart);

      items.forEach(item => {
        const li = document.createElement('li');
        li.className = 'legendElement';

        const circle = document.createElement('span');
        circle.className = 'circleSpan';
        circle.style.backgroundColor = item.fillStyle;


        const text = document.createElement('p');
        text.className = 'textElement';
        text.style.color = 'rgb(162, 160, 160)';
        text.style.fontFamily = 'Varela Round';
        text.style.fontWeight = '500';
        var size_value = disk_free_space;
        var order = '0';
        if(x>0) {
          var size_value = disk_filled_space;
          var order = '2';
        }
        const textElmnt = document.createTextNode(item.text + ': ' + size_value);
        li.style.order = order;
        li.style.textShadow = '0px 0px 10px rgb(26, 26, 26)';
        
        x = 1

        


        ul.appendChild(li);
        li.appendChild(circle);
        li.appendChild(text);
        text.appendChild(textElmnt);
      });
    }

  }
  
      const doughnut_config = {
    type: 'doughnut',
    data: doughnut_data,
    options: {
      layout: {
        padding: 20

      },      
      onClick: function(evt, activeElements) {

        if (activeElements.length > 0) {
            const index = activeElements[0].index;
            const label = doughnut_chart.data.labels[index];
            
            if (label === 'Filled Space') {
              console.log('clicker');
              showFilledDetails();
          }
        }
      },
      onHover: function(evt, activeElements) {
            doughnut_chart.data.datasets[0].hoverOffset = 0;
            
            if (activeElements.length > 0) {
                const index = activeElements[0].index;
                const label = doughnut_chart.data.labels[index];

                if (label === 'Filled Space') {
                  doughnut_chart.data.datasets[0].hoverOffset = 15;
                }
            }
            doughnut_chart.update();
        },
        plugins: {
          legend: {
            display: false
        },
        tooltip: {
          enabled: false
        },
        htmlLegend: {
          containerID: 'legendContainer'
        },
        valuesConvertToPercent: {
          variables: [disk_max_space, disk_filled_space, disk_free_space]
        }

      },
      animation: {
        duration: 2000
      },
      cutout: '75%',
      borderRadius: 5,
      spacing: 2,
      
    },
    plugins: [htmlLegendPlugin, doughnutLabel, valuesConvertToPercent]
  };
  
      const doughnut_chart = new Chart(
        
        document.getElementById('doughnut_chart'),
        doughnut_config
        
      );  

      const originalData = [
        percentage_backups,
        percentage_archives, 
        percentage_documents, 
        percentage_text, 
        percentage_images, 
        percentage_audio,
        percentage_video 
      ];
      const originalLabels = ['Backups', 'Archives', 'Documents', 'Text', 'Images', 'Audio', 'Video'];

      const identifierPrim = ['id1', 'id2', 'id3', 'id4', 'id5', 'id6', 'id7'];
      const identifierSec = ['id8', 'id9', 'id10', 'id11', 'id12', 'id13', 'id14'];

      let merged = identifierPrim.map((idprim, i) => {
        return {
          "idprim": identifierPrim[i], 
          "idsec": identifierSec[i], 
          "datapoint": originalData[i], 
          "label": originalLabels[i]
        };
      });
      
      let filtered = merged.filter(item => item.datapoint > 0);
      
      const dataSort = filtered.sort(function (b, a) {
        return a.datapoint - b.datapoint;
      });
      
      const idp = [];
      const ids = [];
      const ds = [];
      const lbl = [];
      
      for (let i = 0; i < dataSort.length; i++) {
        idp.push(dataSort[i].idprim);
        ids.push(dataSort[i].idsec);
        ds.push(dataSort[i].datapoint);
        lbl.push(dataSort[i].label);
      }

      const bar_data = {
        labels: lbl,
        datasets: [
          {
            label: '',
            data: ds,
            backgroundColor: [
              'rgba(54, 162, 235, 1)'
            ],
              borderSkipped: false,
              identifierPrim: idp,
              identifierSec: ids
          },
        ]
      };

      const bar_config = {
        type: 'bar',
        data: bar_data,
        options: {
          plugins: {
            datalabels: {
              formatter: function(value) {
                return value + '%';
              },
              clamp: false,
              anchor: 'end',
              align: 'end',
              color: '#00030E',
              font: {
                family: 'Rajdhani',
                size: 20,
                weight: 'bold'
              }
            },
            legend: {
              labels: {
                display: false,
                font: {
                  size: 15
                  
                }
              },
              display: false
            }
          },
          layout: {
            padding: {
              right: 50,
              left: 40
            }
          },
          indexAxis: 'y',
          maintainAspectRatio: false,
          barThickness: 40,
          categoryPercentage: '1',
          scales: {
            x: {
              beginAtZero: true,
              ticks: {
                display: false
              },
              grid: {
                drawTicks: false,
                display: false
              }
            },
            y: {
              ticks: {
                display: true,
              },
              grid: {
                drawTicks: false,
                display: false
              }

            }

          }
        },
        plugins: [ChartDataLabels]
      };

      const bar_chart = new Chart(
        
        document.getElementById('bar_chart'),
        bar_config
        
      );


      function showFilledDetails() {

        document.getElementById('detailsContainer').classList.toggle('active')

      }