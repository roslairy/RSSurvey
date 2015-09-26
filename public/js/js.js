Array.prototype.pushIfNotExist = function(insert){
	var exist = false;
	
	$.each(this, function(index,e){
		if (e.selector == insert.selector){
			exist = true;
		}
	});
//	this.forEach(function(e){
//		if (e.selector == insert.selector){
//			exist = true;
//		}
//	});
	if (!exist){
		this.push(insert);
	}
	
};

//解决ie8不支持indexOf的替代方法
function myIndexOf(array, elem){
	var i = 0;
	var len = array.length;
	
	while(i < len){
		if(array[i] == elem)
			return i;
		else 
			i++;
	}
	
}

// 用来插入的块
$.source_div = '<div class="source-container">'+
'			<p class="source-name html-PowerName">1路电源</p>'+
'			<div class="state-container">'+
'				<div class="data-block">'+
'					<div class="center-square html-Power1">'+
'						<p>I路</p>'+
'					</div>'+
'				</div>'+
'				<div class="data-block">'+
'					<div class="center-square square-way1">'+
'						<p class="html-PowerUse1">1路</p>'+
'					</div>'+
'					<p> </p>'+
'				</div>'+
'				<div class="data-block">'+
'					<div class="left-square">'+
'						<p class="html-vol1">123</p>'+
'					</div>'+
'					<p>V</p>'+
'					<div class="left-square">'+
'						<p class="html-cur1">123</p>'+
'					</div>'+
'					<p>A</p>'+
'				</div>'+
'				<div class="data-block">'+
'					<div class="left-square">'+
'						<p class="html-volz1">123</p>'+
'					</div>'+
'					<p>V</p>'+
'					<div class="left-square">'+
'						<p class="html-volzo1">123</p>'+
'					</div>'+
'					<p>Ω</p>'+
'				</div>'+
'				<div class="data-block">'+
'					<div class="left-square">'+
'						<p class="html-volf1">123</p>'+
'					</div>'+
'					<p>V</p>'+
'					<div class="left-square">'+
'						<p class="html-volfo1">123</p>'+
'					</div>'+
'					<p>Ω</p>'+
'				</div>'+
'				<div class="data-block">'+
'					<p class="html-Power1-condition power-condition"></p>'+
'				</div>'+
'			</div>'+
'			<div class="state-container">'+
'				<div class="data-block">'+
'					<div class="center-square html-Power2">'+
'						<p>II路</p>'+
'					</div>'+
'				</div>'+
'				<div class="data-block">'+
'					<div class="center-square">'+
'						<p class="html-PowerUse2">1路</p>'+
'					</div>'+
'					<p> </p>'+
'				</div>'+
'				<div class="data-block">'+
'					<div class="left-square">'+
'						<p class="html-vol2">123</p>'+
'					</div>'+
'					<p>V</p>'+
'					<div class="left-square">'+
'						<p class="html-cur2">123</p>'+
'					</div>'+
'					<p>A</p>'+
'				</div>'+
'				<div class="data-block">'+
'					<div class="left-square">'+
'						<p class="html-volz2">123</p>'+
'					</div>'+
'					<p>A</p>'+
'					<div class="left-square">'+
'						<p class="html-volzo2">123</p>'+
'					</div>'+
'					<p>Ω</p>'+
'				</div>'+
'				<div class="data-block">'+
'					<div class="left-square">'+
'						<p class="html-volf2">123</p>'+
'					</div>'+
'					<p>A</p>'+
'					<div class="left-square">'+
'						<p class="html-volfo2">123</p>'+
'					</div>'+
'					<p>Ω</p>'+
'				</div>'+
'				<div class="data-block">'+
'					<p class="html-Power2-condition power-condition"></p>'+
'				</div>'+
'			</div>'+
'			<div class="rail-container">'+
'			</div>'+
'		</div>';

// 主API，调用这个API可以创建一个电源框
$.appendSource = function (selector, source){
	var obj = $(selector);

	// 清除
	obj.html('');
	// 追加主体
	obj.append($.source_div);

	// 计算轨边柜个数
	obj.gbgCnt = source.rails.length / 2;
	obj.find('.rail-container').append('<div style="float:left;width:' + (3 - obj.gbgCnt) * 55 + 'px;height:30px;"><div/>')

	// 追加轨边柜
	for (var i = 0; i < obj.gbgCnt; i++) {
		obj.find('.rail-container').append(
			'<div class="gbg-container">'+
'					<div class="data-block">'+
'						<div class="gbg-square html-gbg' + i + '-square1">'+
'							<p>I</p>'+
'						</div>'+
'					</div>'+
'					<div class="data-block">'+
'						<div class="gbg-square html-gbg' + i + '-square2">'+
'							<p>II</p>'+
'						</div>'+
'					</div>'+
'					<div class="data-block">'+
'						<p style="margin-left: 16px;">' + source.rails[i * 2] + '</p>'+
'						<p style="margin-left: 16px;">' + source.rails[i * 2 + 1] + '</p>'+
'					</div>'+
'					<div class="rail-square html-rail-' + source.rails[i * 2] + '-square">'+
'						<p class="html-rail-' + source.rails[i * 2] + '-name">123</p>'+
'					</div>'+
'					<div class="rail-square html-rail-' + source.rails[i * 2 + 1] + '-square">'+
'						<p class="html-rail-' + source.rails[i * 2 + 1] + '-name">123</p>'+
'					</div>'+
'				</div>');
	};

	// 初始化闪烁用函数
	obj.state1_gbg1 = function(){};	// 1路电源状态1
	obj.state1_gbg2 = function(){};	// 2路电源状态1
	obj.state2_gbg1 = function(){};	// 1路电源状态2
	obj.state2_gbg2 = function(){};	// 2路电源状态2
	obj.clearShine = function(){
		for (var i = 0; i < source.rails.length; i++) {
			// sconsole.log('.html-rail-' + source.rails[i] + '-square');
			obj.find('.html-rail-' + source.rails[i] + '-square').removeClass('active-square');
			obj.find('.html-rail-' + source.rails[i] + '-name').text('-');
		};
		for (var i = 0; i < obj.gbgCnt; i++) {
			for (var j = 1; j <= 2; j++) {
				// console.log('.html-gbg' + i + '-square' + j);
				obj.find('.html-gbg' + i + '-square' + j).removeClass('active-square');			
			};
		};
	};

	obj.shine1 = [];
	obj.shine2 = [];

	obj.shine = function(shineObj){
		$.each(shineObj, function(index,elem){
			elem.addClass('active-square');
		});
		
	};

	// 状态1的控制函数
	obj.state1_c = function(){
		this.clearShine();
		this.shine(obj.shine1);
		this.state1_gbg1(1);
		this.state1_gbg2(2);
		setTimeout(function(){obj.state2_c();}, 1000);
	};

	// 状态2的控制函数
	obj.state2_c = function(){
		this.clearShine();
		this.shine(obj.shine2);
		this.state2_gbg1(1);
		this.state2_gbg2(2);
		setTimeout(function(){obj.state1_c();}, 1000);
	};
	setTimeout(function(){obj.state1_c();}, 0);

	// 定义更新数据的函数
	obj.update = function(data){


		this.find('.html-PowerName').text(source['PowerName']);
		//判断是否有故障
		var volgood = [true, true];
		
		if(data.vol1 < 100){
			volgood[0] = false;
			this.find('.html-Power1-condition').html(data.condition1);
		} else {
			this.find('.html-Power1-condition').html('');
		}
		if(data.vol2 < 100){
			volgood[1] = false;
			this.find('.html-Power2-condition').html(data.condition2);
		} else {
			this.find('.html-Power2-condition').html('');
		}

		// 清除轨边柜标签
		var _this = this;
		
		$.each(data.rails, function(index,elem){
			_this.find('.html-rail-' + elem + '-name').text('-');
			_this.find('.html-rail-' + elem + '-square').removeClass('active-square');
		});
		
		// 清除闪烁用函数
		obj.state1_gbg1 = function(){};
		obj.state1_gbg2 = function(){};
		obj.state2_gbg1 = function(){};
		obj.state2_gbg2 = function(){};

		obj.shine1 = [];
		obj.shine2 = [];

		// 按2路电源更新数据
		for (var i = 1; i <= 2; i++) {
			// 改变电源状态颜色
			var powerSquare = this.find('.html-Power' + i);
			powerSquare.removeClass('active-square');
			powerSquare.removeClass('bad-square');
			
			if (data['condition' + i].length == 50);
			else if (data['vol' + i] < 100){
				powerSquare.addClass('bad-square');
			} else {
				powerSquare.addClass('active-square');
			}

			// 改变状态值
			this.find('.html-PowerUse' + i).text(data['PowerUse' + i]);
			this.find('.html-vol' + i).text(data['vol' + i]);
			this.find('.html-cur' + i).text(data['cur' + i]);
			this.find('.html-volz' + i).text(data['volz' + i]);
			this.find('.html-volzo' + i).text(data['volzo' + i]);
			this.find('.html-volf' + i).text(data['volf' + i]);
			this.find('.html-volfo' + i).text(data['volfo' + i]);

			// 检查是否有两个轨道
			rails = data['RailwayName' + i].split('/');
			// 1个轨道
			if (!volgood[i - 1]) {
				continue;
			}
			else if (rails.length == 1){
				this.shine1.pushIfNotExist(this.find('.html-rail-' + rails[0] + '-square'));
				this.shine1.pushIfNotExist(this.find('.html-gbg' + Math.floor(myIndexOf(data.rails, rails[0]) / 2) + '-square' + i));
				this.shine2.pushIfNotExist(this.find('.html-rail-' + rails[0] + '-square'));
				this.shine2.pushIfNotExist(this.find('.html-gbg' + Math.floor(myIndexOf(data.rails, rails[0]) / 2) + '-square' + i));
			// 2个轨道
			} else {
				_rails = rails;
				_i = i;
				this.shine1.pushIfNotExist(this.find('.html-rail-' + _rails[0] + '-square'));
				this.shine1.pushIfNotExist(this.find('.html-gbg' + Math.floor(myIndexOf(data.rails, _rails[0]) / 2) + '-square' + _i));				
				this.shine2.pushIfNotExist(this.find('.html-rail-' + _rails[1] + '-square'));
				this.shine2.pushIfNotExist(this.find('.html-gbg' + Math.floor(myIndexOf(data.rails, _rails[1]) / 2) + '-square' + _i));
				
			}
		};

		var railsWays1 = data['RailwayName1'].split('/');
		if (railsWays1.length == 1){
			obj.state1_gbg1 = function(){
				this.find('.html-rail-' + railsWays1[0] + '-name').text(data['RailNum1']);
			};
			obj.state2_gbg1 = function(){
				this.find('.html-rail-' + railsWays1[0] + '-name').text(data['RailNum1']);
			};
		} else {
			obj.state1_gbg1 = function(){
				this.find('.html-rail-' + railsWays1[0] + '-name').text(data['RailNum1']);
			};
			obj.state2_gbg1 = function(){
				this.find('.html-rail-' + railsWays1[1] + '-name').text(data['RailNum1']);
			};
		}

		var railsWays2 = data['RailwayName2'].split('/');
		if (railsWays2.length == 1){
			obj.state1_gbg2 = function(){
				this.find('.html-rail-' + railsWays2[0] + '-name').text(data['RailNum2']);
			};
			obj.state2_gbg2 = function(){
				this.find('.html-rail-' + railsWays2[0] + '-name').text(data['RailNum2']);
			};
		} else {
			obj.state1_gbg2 = function(){
				this.find('.html-rail-' + railsWays2[0] + '-name').text(data['RailNum2']);
			};
			obj.state2_gbg2 = function(){
				this.find('.html-rail-' + railsWays2[1] + '-name').text(data['RailNum2']);
			};
		}
	}

	// 更新数据
	obj.update(source);
	
	return obj;
}

// 示例数据
source_1 = {
	ThisName : 'ThisName',
	PowerName : 'PowerName',
	PowerUse1 : 456,
	vol1 : 345,
	cur1 : 2363,
	volz1 : 454,
	volzo1 : 64,
	volf1 : 236,
	volfo1 : 6456,
	condition1 : 'normal',
	RailwayName1 : 'k5',
	RailNum1 : 'd222',
	PowerUse2 : 456,
	vol2 : 55,
	cur2 : 123,
	volz2 : 123,
	volzo2 : 123,
	volf2 : 123,
	volfo2 : 123,
	condition2 : 'normal',
	RailwayName2 : 'kk1',
	RailNum2 : 'd232',
	rails : [
		'k1',
		'k2',
		'k3',
		'k4',
		'k5',
		'k6'
	]
};
